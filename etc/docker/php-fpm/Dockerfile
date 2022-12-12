FROM php:8.2-fpm

RUN apt update \
    && apt install -y libicu-dev git zip\
    && docker-php-ext-install intl opcache pdo pdo_mysql

#    && apt install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip \
#    && pecl install apcu \
#    && docker-php-ext-enable apcu \
#    && docker-php-ext-configure zip \
#    && docker-php-ext-install zip \
#    && docker-php-ext-install pdo_mysql

# Install PHP DEBUG Extensions
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN true

COPY ./etc/docker/php-fpm/log-php.ini /usr/local/etc/php/conf.d/log-php.ini
RUN true
COPY ./etc/docker/php-fpm/xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN true

RUN chown -R www-data:www-data /var/www


#WORKDIR /var/www/symfony_docker

COPY --from=public.ecr.aws/composer/composer:latest /usr/bin/composer /usr/bin/composer
RUN true

#RUN curl -sS https://get.symfony.com/cli/installer | bash
#RUN mv /root/.symfony/bin/symfony /usr/local/bin/symfony
#RUN git config --global user.email "you@example.com" \
#    && git config --global user.name "Your Name"

WORKDIR /var/www/html/

#COPY . .

# Modify www-data user to match system user
ARG GROUP_ID=1000
ARG USER_ID=1000
RUN true \
    && groupmod www-data --gid "${GROUP_ID}" \
    && usermod www-data --uid "${USER_ID}" --gid www-data -d /var/www -s /bin/bash \
    && chown -R www-data:www-data /var/www
