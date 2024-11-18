#!/bin/bash

./wait-for-it.sh mysql:3306 --timeout=30 --strict -- echo "MySQL is up!"

php artisan migrate --force
php artisan db:seed --force
php artisan storage:link

exec apache2-foreground