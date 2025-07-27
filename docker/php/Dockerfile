FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    zip unzip curl git libzip-dev libpq-dev libonig-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip bcmath

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs

ARG UID=1000
ARG GID=1000
RUN addgroup --gid ${GID} appuser && \
    adduser --disabled-password --gecos "" --uid ${UID} --gid ${GID} appuser

RUN mkdir -p /var/www/html/storage /var/www/html/bootstrap/cache && \
    chown -R appuser:appuser /var/www/html/storage /var/www/html/bootstrap/cache && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

WORKDIR /var/www/html

USER appuser
