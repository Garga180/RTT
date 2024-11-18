#!/bin/bash

./wait-for-it.sh mysql:3306 --timeout=30 --strict -- echo "MySQL is up!"

compose install
php artisan migrate --force
php artisan db:seed --force
php artisan storage:link
php artisan key:generate

exec apache2-foreground