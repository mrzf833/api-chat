# Api Chat

## Dibuat Menggunakan Laravel 8 dan php 7.4

# Cara Pemasangan

## Create Pusher Terlebih Dahulu

## Clone Source Code Ini, Lalu Jalankan

- `composer install`
- `cp .env.example .env`
- `buka dan setting .env nya yaitu`
    - `Sesuaikan Databasenya`
    - `ganti BROADCAST_DRIVER=log menjadi BROADCAST_DRIVER=pusher`
    - `Sesuaikan Data Pusher`
- `php artisan key:generate`
- `php artisan jwt:secret`
- `php artisan migrate:fresh --seed`

# dengan docker
## install
- `sesuaikan file .env.docker.example`
- `docker compose up -d --build`
- `docker exec -it api_chat_app /bin/sh`
- `php artisan migrate:fresh --seed`

## uninstall
- `docker compose down --rmi=all`

## Jika Sudah Memasang Api Chatnya Silahkan Lanjutkan pemasangan Frontendnya ya itu <a href="https://github.com/mrzf833/web-chat.git">Web Chat</a>

# USER Default

```
1. username: user1
1. password: user1

2.username: user2
2.password: user2
```

# API Spec



## No Authentication

## Login

Request :
- Method : POST
- Endpoint : `/api/login`
- Body : 

    ```json
    {
        "username" : "required",
        "password" : "required"
    }
    ```

Response :
```json
{
    "token" : "secret api key"
}
```

## Register

Request :
- Method : POST
- Endpoint : `/api/login`
- Body : 

    ```json
    {
        "username" : "required",
        "password" : "required"
    }
    ```

Response :
```json
{
    "message": "user berhasil di buat"
}
```

## All User

Request :
- Method : GET
- Endpoint : `/api/all-user`

Response :
```json
{
    "data": [
        {
            "username": "user1"
        },
        {
            "username": "user2"
        }
    ]
}
```





## Authentication

Request :
- Header :
    - Content-Type : "application/json"
    - Accept : "application/json"
    - Authorization : "Bearer " + "your secret api key"


## User

Request :
- Method : GET
- Endpoint : `/api/user`

Response :
```json
{
    "data" : {
        "id": 1,
        "name": "user1",
        "username": "user1",
        "created_at": "2021-05-13T15:38:47.000000Z",
        "updated_at": "2021-05-13T15:39:03.000000Z"
    }
}
```

## Logout

Request :
- Method : POST
- Endpoint : `/api/logout`

Response :
```json
{
    "message": "user berhasil logout"
}
```

## close window (mengupdate field updated_at user untuk keperluan terakhir_dilihat)

Request :
- Method : GET
- Endpoint : `/api/close/window`

Response :
```json
{
    "message": "user berhasil di update"
}
```

## check online user yang sudah berteman

Request :
- Method : GET
- Endpoint : `/api/check/online`

Response :
```json
[
    {
        "id": 2,
        "status": "13/05/2021 22:46"
    }
]
```

## contact yang sudah berteman / diterima

Request :
- Method : GET
- Endpoint : `/api/contact`

Response :
```json
{
    "data": [
        {
            "id": 1,
            "friend": {
                "id": 2,
                "name": "user2",
                "username": "user2",
                "terakhir_dilihat": "13/05/2021 22:46",
                "pesan_terakhir": null,
                "as_pesan": "penerima",
                "read_at": null
            },
            "status": "diterima",
            "created_at": "2021-05-13T15:39:01.000000Z",
            "updated_at": "2021-05-13T15:39:11.000000Z"
        }
    ]
}
```

## Permintaan Pertemanan

Request :
- Method : POST
- Endpoint : `/api/contact`
- Body : 

    ```json
    {
        "friend": "username user"
    }
    ```

Response :
```json
{
    "message": "contact pertemanan berhasil di kirim"
}
```

## contact yang masih dalam proses

Request :
- Method : GET
- Endpoint : `/api/contact/proses`

Response :
```json
{
    "data": [
        {
            "id": 2,
            "friend": {
                "id": 4,
                "name": "user3",
                "username": "user3",
                "terakhir_dilihat": "14/05/2021 10:45",
                "pesan_terakhir": null,
                "as_pesan": "penerima",
                "read_at": null
            },
            "status": "proses",
            "created_at": "2021-05-14T03:46:11.000000Z",
            "updated_at": "2021-05-14T03:46:11.000000Z"
        }
    ]
}
```

## contact yang di tolak

Request :
- Method : GET
- Endpoint : `/api/contact/tolak`

Response :
```json
{
    "data": [
        {
            "id": 2,
            "friend": {
                "id": 4,
                "name": "user3",
                "username": "user3",
                "terakhir_dilihat": "14/05/2021 10:45",
                "pesan_terakhir": null,
                "as_pesan": "penerima",
                "read_at": null
            },
            "status": "ditolak",
            "created_at": "2021-05-14T03:46:11.000000Z",
            "updated_at": "2021-05-14T03:54:45.000000Z"
        }
    ]
}
```

## contact yang perlu di konfirmasi

Request :
- Method : GET
- Endpoint : `/api/contact/konfirmasi`

Response :
```json
{
    "data": [
        {
            "id": 2,
            "friend": {
                "id": 1,
                "name": "user1",
                "username": "user1",
                "terakhir_dilihat": "2021-05-14T03:28:19.000000Z"
            },
            "status": "proses",
            "created_at": "2021-05-14T03:46:11.000000Z",
            "updated_at": "2021-05-14T03:46:11.000000Z"
        }
    ]
}
```

## Mengonfirmasi Pertemanan

Request :
- Method : PATCH
- Endpoint : `/api/konfirmasi/{user_id}`
- Body : 

    ```json
    {
        "status": "ditolak|diterima"
    }
    ```

Response :
```json
{
    "message": "contact berhasil di ditolak atau diterima" 
}
```


## read all message

Request :
- Method : GET
- Endpoint : `/api/message/read-message/{user_id}`

Response :
```json
{
    "message": "message berhasil di read semua"
}
```

## melihat profile pertemanan

Request :
- Method : GET
- Endpoint : `/api/message/user/{user_id}`

Response :
```json
{
    "id": 1,
    "name": "user1",
    "username": "user1",
    "terakhir_dilihat": "online"
}
```

## mendapatkan message friend

Request :
- Method : GET
- Endpoint : `/api/message/{user_id}?skip=0`

Response :
```json
{
    "data": [
        {
            "id": 1,
            "pengirim": 1,
            "penerima": 2,
            "pesan": "saasas",
            "read_at": "14/05/2021 19:40",
            "created_at": "14/05/2021 19:40",
            "timestamp": 1620996009,
            "time": "19.40"
        }
    ]
}
```

## Kirim Pesan

Request :
- Method : POST
- Endpoint : `/api/message/{user_id}`
- Body : 

    ```json
    {
        "pesan" : "required"
    }
    ```

Response :
```json
{
    "message": {
        "pengirim": 2,
        "penerima": "1",
        "pesan": "hallo bro",
        "updated_at": "2021-05-14T12:56:58.000000Z",
        "created_at": "2021-05-14T12:56:58.000000Z",
        "id": 9
    }
}
```
