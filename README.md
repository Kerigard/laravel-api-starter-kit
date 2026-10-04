# Laravel API Starter Kit

Laravel API starter kit with Dockerized local and production environments, PostgreSQL, Redis, and Nginx.

- Versioned API routes under /api/v1.
- Redis-backed request throttling.
- Strict Eloquent models and lazy-loading prevention in development.
- Validation that rejects unknown request fields.
- Destructive database commands disabled in production.
- HTTPS enforced when the application URL uses HTTPS.
- PHPUnit, Pint, Rector, and PHPStan for testing and code quality.

## Installation

Create a new project with Composer:

```bash
composer create-project --no-install kerigard/laravel-api-starter-kit example-app
```

## Development

Start the application for the first time:

```bash
WWWUSER="$(id -u)" WWWGROUP="$(id -g)" docker compose up -d
sail artisan migrate --seed
```

For subsequent runs, use `sail`:

```bash
sail up -d
```

> [!NOTE]
> Run Docker and Sail commands as a regular user to avoid file permission issues.

To start the queue worker and scheduler:

```bash
sail --profile "*" up -d
```

Alternatively, enable them by default in `.env`:

```dotenv
COMPOSE_PROFILES=scheduler,worker
```

Useful development commands:

```bash
sail test
sail pint
sail bin rector
sail bin phpstan analyse --memory-limit=1G
```

## Production

```bash
cp .env.example .env
docker compose -f compose.prod.yaml up -d --build
docker compose -f compose.prod.yaml exec app php artisan migrate
```

> [!NOTE]
> Configure the environment variables in `.env` before starting the application.

## License

MIT
