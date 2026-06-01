FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git unzip zip curl \
    libpng-dev libjpeg-dev libfreetype6-dev libzip-dev \
    nodejs npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql gd zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader --no-scripts
RUN npm ci
RUN npm run build

RUN php artisan optimize:clear
RUN php artisan config:clear
RUN php artisan route:clear
RUN php artisan view:clear

RUN mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache storage/logs bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

CMD php artisan migrate:fresh --force && php -S 0.0.0.0:${PORT} -t public