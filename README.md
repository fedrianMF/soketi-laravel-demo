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
docker run --name postgres-dev -p 5432:5432 -e POSTGRES_USER=pgsql -e POSTGRES_PASSWORD=pgsql-secretpassword -e POSTGRES_DB=chat-ap
p -d postgres
```

2. **Soketi** - Servidor WebSocket para conexiones en tiempo real
```bash
docker run --name soketi-dev -p 6001:6001 -p 9601:9601 -e SOKETI_DEFAULT_APP_ID=some-id -e SOKETI_DEFAULT_APP_KEY=some
-key -e SOKETI_DEFAULT_APP_SECRET=some-secret -e SOKETI_DEFAULT_APP_ENABLED=true -d quay.io/soketi/soketi:1.4-16-alpine
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
