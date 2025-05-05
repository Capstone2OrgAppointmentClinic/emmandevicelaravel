# Use official PHP 8.2 FPM image
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www

# Install dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    zip unzip curl git \
    libpq-dev libzip-dev \
    gnupg ca-certificates \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Node.js 20.x and npm
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application code into the container
COPY . .

# Install Composer dependencies
RUN composer install

# Install Node.js dependencies (for frontend assets)
RUN npm install

# Build frontend assets (if applicable)
RUN npm run build

# Set proper permissions for Laravel storage and cache directories
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Expose Laravel port (8080)
EXPOSE 8080

# Start the Laravel application using artisan (for development)
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
