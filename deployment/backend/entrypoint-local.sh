#!/bin/bash

set -euo pipefail

chown -R www-data:www-data /application

composer install

rm -rf bootstrap/cache/*
php artisan optimize
php artisan config:clear
php artisan cache:clear
#php artisan migrate:fresh --seed # add temporarily
#php artisan migrate --force


echo "Start FPM"
exec "$@"
