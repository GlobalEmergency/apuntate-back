FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
        libicu-dev \
        libpq-dev \
        libzip-dev \
        zip \
        git \
        unzip \
        nginx \
        supervisor \
    && docker-php-ext-configure intl \
    && docker-php-ext-install -j$(nproc) \
        pdo \
        pdo_mysql \
        pdo_pgsql \
        intl \
        zip \
        opcache

# Install Xdebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

ARG GROUP_ID=1000
ARG USER_ID=1000
RUN true \
    && groupmod www-data --gid "${GROUP_ID}" \
    && usermod www-data --uid "${USER_ID}" --gid www-data -d /var/www -s /bin/bash

# Install Composer
COPY --from=public.ecr.aws/composer/composer:latest /usr/bin/composer /usr/bin/composer
RUN true

# Copy conf files
COPY ./etc/docker/php-fpm/default /etc/nginx/sites-available/default
RUN true
COPY ./etc/docker/php-fpm/log-php.ini /usr/local/etc/php/conf.d/log-php.ini
RUN true
COPY ./etc/docker/php-fpm/dev/xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN true
COPY ./etc/docker/php-fpm/dev/supervisord.conf /etc/supervisor/supervisord.conf
RUN true
COPY ./etc/docker/php-fpm/dev/docker-entrypoint.sh /etc/docker-entrypoint.sh

RUN true
RUN mkdir -p /opt/phpstorm-coverage && chmod -R 777 /opt/phpstorm-coverage

##INSTALL DATADOG AGENT
#RUN true \
#    && curl -LO https://github.com/DataDog/dd-trace-php/releases/latest/download/datadog-setup.php \
#    && php datadog-setup.php --php-bin=all --enable-profiling \
#;

ARG GIT_SHA="unknown"
ENV GIT_SHA=${GIT_SHA}
ENV DD_VERSION=${GIT_SHA}

LABEL "com.datadoghq.tags.version"=$(GIT_SHA)
LABEL "org.opencontainers.image.revision"=$(GIT_SHA)
LABEL "org.opencontainers.image.source"="github.com/Zepo-Awareness/apuntate"

RUN true \
    && chown -R www-data:www-data /tmp \
    && chown -R www-data:www-data /etc/docker-entrypoint.sh \
    && chmod +x /etc/docker-entrypoint.sh \
    && touch /run/nginx.pid \
    && chown -R www-data:www-data /run/nginx.pid \
    && chown -R www-data:www-data /var/lib/nginx \
    && chown -R www-data:www-data /var/log/nginx \
    && touch /run/supervisord.pid \
    && chown -R www-data:www-data /run/supervisord.pid \
    && chown -R www-data:www-data /var/log/supervisor \
    && echo "access.log = /dev/null" >> /usr/local/etc/php-fpm.d/www.conf

RUN chown -R www-data:www-data /var/www/html \
        && find /var/www/html -type f -exec chmod 644 {} \; \
        && find /var/www/html -type d -exec chmod 755 {} \;

WORKDIR /var/www/html/

USER www-data

COPY --chown=www-data . .

RUN composer install --no-scripts --no-interaction --no-progress --no-suggest

USER root

CMD ["sh", "-c", "/etc/docker-entrypoint.sh"]

EXPOSE 80
