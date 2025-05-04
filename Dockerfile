# Step 1: Use an official PHP image with Apache
FROM php:8.2-apache

# Step 2: Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libonig-dev \
    libzip-dev \
    zip \
    curl \
    git \
    nano \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    gnupg \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql zip mbstring gd \
    && a2enmod rewrite

# Step 3: Install Node.js v20.x and update npm
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm@latest

# Step 4: Set working directory
WORKDIR /var/www/html

# Step 5: Copy project files into container
COPY . .

# Step 6: Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Step 7: Install backend dependencies
RUN composer install --optimize-autoloader --no-dev

# Step 8: Install and build frontend assets
RUN npm install && npm run build

# Step 9: Set directory permissions for Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Step 10: Set Apache DocumentRoot to Laravel's public folder
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Step 11: Update Apache config to use Laravel's public folder as root
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Step 12: Expose port 80
EXPOSE 80

# Step 13: Start Apache in the foreground
CMD ["apache2-foreground"]
