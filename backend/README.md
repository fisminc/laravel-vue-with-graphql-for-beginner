# backend

## Description
TwitterLikeのバックエンドです。

## Environment
- macOS High Sierra version:10.13.6
- Docker Desktop version:2.0.0.3

## Project setup

```
$ cd backend

$ composer install

$ docker-compose up -d

$ cp .env.example .env
DB接続情報を設定
DB_DATABASE=twitter
DB_USERNAME=root
DB_PASSWORD=pass

$ php artisan key:generate

$ php artisan jwt:secret
This will invalidate all existing tokens. Are you sure you want to override the secret key? (yes/no) [no]:
> yes
 
$ php artisan migrate
$ php artisan serv
```

## graphql-playground
```
下記コマンドを実行し、URLにアクセス
$ docker-compose up -d
$ php artisan serv
http://localhost:8000/graphql-playground
```
