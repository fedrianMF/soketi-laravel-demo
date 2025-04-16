## WEBSOCKETS

Este es un mini proyecto en laravel basado en el [demo repository](https://github.com/beyondcode/laravel-websockets-demo) de [Laravel WebSockets](https://beyondco.de/docs/laravel-websockets/getting-started/introduction) con [Soketi](https://docs.soketi.app/). Para manejar las notificaciones y sockets en tiempo real.

## 🚀 Requisitos previos

- [Docker](https://docs.docker.com/get-docker/) instalado
- PHP 8.x y Composer
- NodeJS v20+

## 🐋 Contenedores Docker necesarios

Este proyecto utiliza:

1. **PostgreSQL** - Base de datos principal
```bash
docker run --name postgres-dev -p 5432:5432 \
-e POSTGRES_USER=pgsql -e POSTGRES_PASSWORD=pgsql-secretpassword \
-e POSTGRES_DB=chat-ap p -d postgres
```

2. **Soketi** - Servidor WebSocket para conexiones en tiempo real
```bash
docker run --name soketi-dev -p 6001:6001 -p 9601:9601 \
-e SOKETI_DEFAULT_APP_ID=some-id -e SOKETI_DEFAULT_APP_KEY=some-key \
-e SOKETI_DEFAULT_APP_SECRET=some-secret -e SOKETI_DEFAULT_APP_ENABLE_CLIENT_MESSAGES=true \
-d quay.io/soketi/soketi:1.4-16-alpine
```

## ☑️ Pasos para Desarrollo

Sigue los pasos para levantar el proyecto

```bash
git clone 
cd soketi-laravel-demo
composer install
npm install
cp .env.example .env
php artisan key:generate
```

Cambiar las siguientes variables del archivo .env


    DB_CONNECTION=pgsql
    DB_HOST=127.0.0.1
    DB_PORT=5432
    DB_DATABASE=chat-app
    DB_USERNAME=pgsql
    DB_PASSWORD=pgsql-secretpassword

    PUSHER_HOST=127.0.0.1
    PUSHER_PORT=6001
    PUSHER_APP_ID=some-id
    PUSHER_APP_KEY=some-key
    PUSHER_APP_SECRET=some-secret

    MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
    MIX_PUSHER_HOST="${PUSHER_HOST}"
    MIX_PUSHER_PORT="${PUSHER_PORT}"
    MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
    MIX_PUSHER_SCHEME="${PUSHER_SCHEME}"

Continua con los siguientes comandos

```bash
php artisan migrate
composer dev
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
