FROM php:8.3-cli-bookworm AS base

WORKDIR /var/www/html

ENV COMPOSER_ALLOW_SUPERUSER=1 \
    COMPOSER_CACHE_DIR=/tmp/composer-cache

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        ca-certificates \
        curl \
        git \
        libicu-dev \
        libpq-dev \
        libzip-dev \
        unzip \
        zip \
    && docker-php-ext-install intl pcntl pdo_pgsql zip \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY composer.json composer.lock ./
RUN composer install --no-interaction --prefer-dist --no-scripts --no-progress \
    && composer clear-cache

COPY . .

RUN composer dump-autoload --optimize \
    && mkdir -p storage bootstrap/cache \
    && chmod -R ug+rwX storage bootstrap/cache

EXPOSE 8000 8080

FROM base AS dev

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]

FROM base AS prod-like

RUN php artisan package:discover --ansi || true

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
