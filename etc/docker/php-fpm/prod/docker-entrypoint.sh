#!/usr/bin/env bash

su -s /bin/bash -c "/usr/local/bin/php bin/console cache:clear" www-data
su -s /bin/bash -c "/usr/local/bin/php bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration" www-data

/usr/bin/supervisord
