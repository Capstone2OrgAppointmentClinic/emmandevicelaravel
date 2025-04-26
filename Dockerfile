# Use official PHP image
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    git \
    unzip \
    curl \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    nodejs \
    npm \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd \
    && rm -rf /var/lib/apt/lists/*

# Install Composer (using Composer's latest version)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set the working directory inside the container
WORKDIR /var/www

# Copy the application files to the working directory
COPY . .

# Install PHP dependencies (without dev dependencies and optimized autoloader)
RUN composer install --no-dev --optimize-autoloader

# Install Node.js dependencies and build the project
RUN npm install && npm run build

# Set permissions for the application files
RUN chown -R www-data:www-data /var/www

# Expose the port that the app will run on
EXPOSE 8000

# Run migrations and start the PHP server
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8000
