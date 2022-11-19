include .env


.PHONY: up
up:
	@docker-compose up -d

.PHONY: down
down:
	@docker-compose down

.PHONY: sh
sh:
	@docker exec -u "$(id -u):$(id -g)" -it ${SERVICE}-php-fpm bash

.PHONY: composer
composer:
	@docker exec -u "$(id -u):$(id -g)" --tty ${SERVICE}-php-fpm composer install --no-interaction

.PHONY: tests
ifdef suite
TESTS_SUITE=--testsuite $(suite)
endif

.PHONY: tests
tests:
	@docker exec -u "$(id -u):$(id -g)" --tty -e APP_ENV=test ${SERVICE}-php-fpm php -dxdebug.mode=off ./bin/phpunit $(TESTS_SUITE)

.PHONY: db-update
ifdef env
ENV=--env=$(env)
endif
db-update: ## Recreate database schema
	@docker exec -u www-data --tty ${SERVICE}-php-fpm php ./bin/console doctrine:database:drop --if-exists --force $(ENV)
	@docker exec -u www-data --tty ${SERVICE}-php-fpm php ./bin/console doctrine:database:create $(ENV)
#	@docker exec -u www-data --tty ${SERVICE}-php-fpm php ./bin/console doctrine:query:sql 'CREATE SCHEMA solarproduct' $(ENV)
#	@docker exec -u www-data --tty ${SERVICE}-php-fpm php ./bin/console doctrine:query:sql 'CREATE EXTENSION IF NOT EXISTS "uuid-ossp"' $(ENV)
	@docker exec -u www-data --tty ${SERVICE}-php-fpm php ./bin/console doctrine:migrations:migrate --no-interaction $(ENV)

.PHONY: migrate
migrate: ## Run migrations
	@docker exec -u www-data --tty ${SERVICE}-php-fpm php ./bin/console doctrine:migrations:migrate --no-interaction

.PHONY: migrate-test
migrate-test: ## Run migrations test environment
	@docker exec -u www-data --tty ${SERVICE}-php-fpm php ./bin/console doctrine:migrations:migrate --env=test --no-interaction

.PHONY: phpcs-fixer
phpcs-fixer: ## Execute coding standards fixer
	@docker exec -u "$(id -u):$(id -g)" --tty ${SERVICE}-php-fpm php -dxdebug.mode=off bin/php-cs-fixer fix src
	@docker exec -u "$(id -u):$(id -g)" --tty ${SERVICE}-php-fpm php -dxdebug.mode=off bin/php-cs-fixer fix tests

.PHONY: phpcs-validate
phpcs-validate: ## Execute coding standards validation
	@docker exec -u "$(id -u):$(id -g)" --tty ${SERVICE}-php-fpm php -dxdebug.mode=off bin/php-cs-fixer fix src --dry-run --diff --stop-on-violation
	@docker exec -u "$(id -u):$(id -g)" --tty ${SERVICE}-php-fpm php -dxdebug.mode=off bin/php-cs-fixer fix tests --dry-run --diff --stop-on-violation
