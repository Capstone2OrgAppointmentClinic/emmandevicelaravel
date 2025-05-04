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
    gnupg \
    && docker-php-ext-install pdo pdo_mysql zip mbstring gd \
    && a2enmod rewrite

# Step 3: Install Node.js v20.x
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm@latest \
    && apt-get install -y unzip

# Step 4: Set the working directory
WORKDIR /var/www/html

# Step 5: Copy your Laravel app
COPY . .

# Step 6: Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Step 7: Install PHP and Node dependencies
RUN composer install --optimize-autoloader --no-dev
RUN npm install

# Step 8: Build frontend assets (optional)
RUN npm run build

# Step 9: Run database migrations
RUN php artisan migrate --force

# Step 10: Set proper permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Step 11: Expose port 80
EXPOSE 80

# Step 12: Start Laravel and Apache
CMD php artisan serve --host=0.0.0.0 --port=8000 & apache2-foreground
