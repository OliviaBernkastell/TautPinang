# Use an official PHP 8.3 FPM image with necessary extensions
FROM php:8.3-fpm

# Install system dependencies for Laravel and Composer
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql zip mbstring exif pcntl bcmath gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Copy only composer files first to leverage Docker cache
COPY composer.json composer.lock ./

# Install PHP dependencies without dev dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Copy all app files
COPY . .

# Set file permissions for Laravel storage and bootstrap cache
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Expose port 9000 (for PHP-FPM)
EXPOSE 9000

# Entry point command for PHP-FPM
CMD ["php-fpm"]
