# Step 1: Use an official PHP image as the base
FROM php:8.2-apache

# Step 2: Install dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libonig-dev \
    libzip-dev \
    zip \
    curl \
    git \
    nano \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-install pdo pdo_mysql zip mbstring gd \
    && a2enmod rewrite

# Step 3: Install Node.js (for npm) and other dependencies
RUN curl -sL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm@latest \
    && apt-get install -y unzip

# Step 4: Set the working directory to /var/www/html
WORKDIR /var/www/html

# Step 5: Copy your Laravel app into the container
COPY . .

# Step 6: Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Step 7: Install Composer dependencies
RUN composer install

# Step 8: Install Node.js dependencies
RUN npm install

# Step 9: Build frontend assets using npm (optional if you're using Vue/React)
RUN npm run build

# Step 11: Set proper file permissions for Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Step 12: Expose port 80 for Apache
EXPOSE 80

# Step 13: Start Apache server and PHP Laravel app
CMD php artisan serve --host=0.0.0.0 && apache2-foreground
