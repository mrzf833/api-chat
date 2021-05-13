# Api Chat

## Dibuat Menggunakan Laravel 8 dan php 7.4

# Cara Pemasangan

## Create Pusher Terlebih Dahulu

## Clone Source Code Ini, Lalu Jalankan

- `composer install`
- `cp .env.example .env`
- `setting .env nya yaitu`
    - `Sesuaikan Databasenya`
    - `ganti BROADCAST_DRIVER=log menjadi BROADCAST_DRIVER=pusher`
    - `Sesuaikan Data Pusher`
- `php artisan key:generate`
- `php artisan migrate:fresh --seed`

## Jika Sudah Memasang Api Chatnya Silahkan Lanjutkan pemasangan Frontendnya ya itu <a href="">Web Chat</a>
