# Use official PHP 8.3 FPM image suitable for Laravel
FROM php:8.3-fpm

# Install system dependencies for Laravel and debugging tools
RUN apt-get update && apt-get install -y \
    git unzip zip curl vim \
    libzip-dev libonig-dev libpng-dev libpq-dev \
    && docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl bcmath gd

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . .

# Install PHP dependencies (no optimization for faster rebuilds)
RUN composer install

# Install npm and node for asset building if needed
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && apt-get install -y nodejs
RUN npm install
RUN npm run dev

# Expose port 9000 for PHP-FPM
EXPOSE 9000

# Run php-fpm server for Laravel
CMD ["php-fpm"]
