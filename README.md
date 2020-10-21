# SLIM 4 - Gravity Simulator API

HTTP-based API for basic CrUD and processing of a “2d falling rock world”

Using [Slim PHP micro framework](https://www.slimframework.com).
With help from [maurobonfietti slim4-api-skeleton](https://github.com/maurobonfietti/slim4-api-skeleton).

## QUICK INSTALL:

### Requirements:

- Docker.

### With Docker:

If you like Docker, you can use this project with **docker** and **docker-compose**.


**Minimal Docker Version:**

* Engine: 18.03+
* Compose: 1.21+


**Docker Commands:**

```bash
# Create and start containers for the API.
$ docker-compose up -d --build

# Install Required Packages
$ docker run -it -v `pwd`:/var/www/html simulator_php-fpm composer install

# Start containers for the API.
$ docker-compose up

# Checkout the API.
$ curl http://localhost:8081

# Stop and remove containers.
$ docker-compose down

# Run Tests
$ docker run -it -v `pwd`:/var/www/html simulator_php-fpm composer test
```


## DEPENDENCIES:

### LIST OF REQUIRE DEPENDENCIES:

- [slim/slim](https://github.com/slimphp/Slim): Slim is a PHP micro framework that helps you quickly write simple yet powerful web applications and APIs.
- [slim/psr7](https://github.com/slimphp/Slim-Psr7): PSR-7 implementation for use with Slim 4.
- [pimple/pimple](https://github.com/silexphp/Pimple): A small PHP dependency injection container.

## ENDPOINTS:

### API Routs:

- Hello: `GET /api/vi/api`

- Health Check: `GET /api/vi/status`

