# SIRHPLUS backend

## Installation

```sh
docker-compose -f docker-compose.yaml -f docker-compose-local.yaml build
docker-compose -f docker-compose.yaml -f docker-compose-local.yaml up -d
docker-compose -f docker-compose.yaml -f docker-compose-local.yaml ps
```

## Executer container

```sh
docker exec -it php bash
```

## Setup dev environment

### Env variables

Create a `.env.local` file at the root of the project

Add the following value there

```sh
DATABASE_URL="mysql://ydux7352_remi:Sternan-29290@mysql:3306/ydux7352_sirhplus?serverVersion=8&charset=utf8mb4"
CORS_ALLOW_ORIGIN='^http?://(localhost|127\.0\.0\.1)(:[0-9]+)?$'
```

### Dependencies installation

`composer install`

### Database migration

`php bin/console d:s:u --force`

### Load fixture

`php bin/console doctrine:fixtures:load`

### Configure JWT

Run the following command to create your JWT certificate `php bin/console lexik:jwt:generate-keypair --overwrite`
