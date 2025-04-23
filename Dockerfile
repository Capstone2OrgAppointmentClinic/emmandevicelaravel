FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    curl \
    bash \
    gnupg \
    unzip \
    git \
    zip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libcurl4-openssl-dev

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN curl -sL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs && \
    npm install -g npm@latest && \
    npm install && \
    npm run build

EXPOSE 8080

CMD php artisan serve --host=0.0.0.0 --port=8080