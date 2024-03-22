PROJECT_NAME := apuntate

.PHONY: install
install: build composer
	$(MAKE) db-update
	$(MAKE) db-update env=test
	$(MAKE) tests

.PHONY: build
build:
	@docker build -t cosmo-php-fpm -f etc/docker/php-fpm/dev/Dockerfile .
	@docker build -t cosmo-pgsql -f etc/docker/postgres/Dockerfile etc/docker/postgres

.PHONY: build-prod
build-prod:
	@docker build -t cosmo-php-fpm -f etc/docker/php-fpm/prod/Dockerfile .

.PHONY: up
up:
	docker-compose -f etc/docker/docker-compose.yaml -f etc/docker/docker-compose.dev.yaml -p $(PROJECT_NAME) up -d
	make composer

.PHONY: up-gha
up-gha:
	@docker-compose -f etc/docker/docker-compose.yaml -p $(PROJECT_NAME) up -d

.PHONY: down
down:
	@docker-compose -f etc/docker/docker-compose.yaml -f etc/docker/docker-compose.dev.yaml -p $(PROJECT_NAME) down

.PHONY: sh
sh:
	@docker exec -u www-data -it $(PROJECT_NAME)-php-fpm bash

.PHONY: composer
composer:
	@docker exec -u www-data --tty $(PROJECT_NAME)-php-fpm composer install --no-interaction

.PHONY: db-update
ifdef env
ENV=--env=$(env)
endif
db-update: ## Recreate database schema
	@docker exec -u www-data --tty $(PROJECT_NAME)-php-fpm php ./bin/console doctrine:database:drop --if-exists --force $(ENV)
	@docker exec -u www-data --tty $(PROJECT_NAME)-php-fpm php ./bin/console doctrine:database:create $(ENV)
	@docker exec -u www-data --tty $(PROJECT_NAME)-php-fpm php ./bin/console doctrine:query:sql 'CREATE SCHEMA cosmo' $(ENV)
	@docker exec -u www-data --tty $(PROJECT_NAME)-php-fpm php ./bin/console doctrine:query:sql 'CREATE EXTENSION IF NOT EXISTS "uuid-ossp"' $(ENV)
	@docker exec -u www-data --tty $(PROJECT_NAME)-php-fpm php ./bin/console doctrine:migrations:migrate --no-interaction $(ENV)

.PHONY: migrate
migrate:
	@docker exec -u www-data --tty $(PROJECT_NAME)-php-fpm php ./bin/console doctrine:migrations:migrate --no-interaction

.PHONY: migrations-diff
migrations-diff:
	@docker exec -u www-data --tty $(PROJECT_NAME)-php-fpm php ./bin/console doctrine:migrations:diff --no-interaction

.PHONY: phpcs-fixer
phpcs-fixer:
	@docker exec -u www-data --tty $(PROJECT_NAME)-php-fpm php -dxdebug.mode=off vendor/bin/php-cs-fixer fix

.PHONY: phpcs-validate
phpcs-validate:
	@docker exec -u www-data --tty $(PROJECT_NAME)-php-fpm php -dxdebug.mode=off vendor/bin/php-cs-fixer fix --dry-run --diff --stop-on-violation

.PHONY: phpstan
phpstan:
	@docker exec -u www-data --tty $(PROJECT_NAME)-php-fpm php vendor/bin/phpstan analyse -c phpstan.neon -l 2 src tests --no-interaction --xdebug

.PHONY: tests
ifdef suite
TESTS_SUITE=--testsuite $(suite)
endif

.PHONY: tests
tests:
#	@make db-update env=test
	@docker exec -u www-data --tty -e APP_ENV=test $(PROJECT_NAME)-php-fpm php -dxdebug.mode=coverage vendor/bin/phpunit $(TESTS_SUITE)
.PHONY: coverage

coverage:
	@make db-update env=test
	@docker exec -u www-data --tty -e APP_ENV=test $(PROJECT_NAME)-php-fpm php -dxdebug.mode=coverage vendor/bin/phpunit
