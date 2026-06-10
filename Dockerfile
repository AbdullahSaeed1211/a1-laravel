FROM php:8.4-cli-alpine AS base

RUN apk add --no-cache \
    bash curl git libpng-dev libjpeg-turbo-dev libwebp-dev libxml2-dev \
    icu-dev oniguruma-dev openssl-dev zip unzip nodejs npm $PHPIZE_DEPS

RUN pecl install mongodb-2.2.0 && docker-php-ext-enable mongodb

RUN docker-php-ext-configure gd --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) \
        bcmath dom fileinfo gd intl mbstring pcntl pdo xml

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install --no-interaction --no-dev --optimize-autoloader --no-scripts

COPY package.json package-lock.json* ./
RUN npm ci --prefer-offline 2>/dev/null || npm install

COPY . .

RUN npm run build

RUN composer run-script post-autoload-dump --no-interaction 2>/dev/null || true

RUN mkdir -p storage/logs storage/framework/cache storage/framework/sessions \
        storage/framework/views bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 8080

CMD php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache \
    && php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
