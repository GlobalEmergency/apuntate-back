#!/usr/bin/env bash
usermod -u 1000 www-data
groupmod -g 1000 www-data

chown -R www-data:www-data /var/www/html

/usr/bin/supervisord
