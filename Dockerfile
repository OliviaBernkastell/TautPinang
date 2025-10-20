# Use a PHP 8.3 FPM + Nginx base image suitable for Laravel
FROM serversideup/php:8.3-fpm-nginx

# Enable debugging extensions
RUN apt-get update && apt-get install -y \
    vim curl git unzip zip \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

# Set up Xdebug configuration for remote debugging
RUN echo "zend_extension=xdebug.so" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.client_port=9003" >> /usr/local/etc/php/conf.d/xdebug.ini

# Install Node.js and npm for frontend asset building and debugging
RUN curl -sL https://deb.nodesource.com/setup_20.x | bash - && apt-get install -y nodejs

# Set working directory
WORKDIR /var/www/html

# Copy all app files and set permissions suitable for Laravel
COPY --chown=www-data:www-data . /var/www/html

# Install PHP dependencies without optimizing for faster build during debugging
USER www-data
RUN composer install

# Install npm packages and build frontend assets
RUN npm install
RUN npm run dev

# Expose port 80 for web server
EXPOSE 8080

# Start PHP-FPM and Nginx in foreground for debugging
CMD ["sh", "-c", "php-fpm && nginx -g 'daemon off;'"]
