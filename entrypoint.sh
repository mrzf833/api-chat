#!/bin/bash

# Periksa apakah file status sudah ada
if [ ! -d "vendor" ]; then
    # Jalankan perintah yang diinginkan, misalnya composer install
    composer update
    php artisan key:generate
    php artisan jwt:secret
    php artisan migrate:fresh --seed
    php artisan storage:link
fi