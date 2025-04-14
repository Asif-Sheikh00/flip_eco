# Use the official PHP image with the necessary extensions
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    nginx \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    unzip \
    git \
    libzip-dev \
    libsqlite3-dev \
    libonig-dev \
    libxml2-dev \
    libcurl4-openssl-dev \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite zip mbstring xml curl

# Set the working directory
WORKDIR /var/www

# Set Composer to allow running as root (not generally recommended)
ENV COMPOSER_ALLOW_SUPERUSER=1

# Copy existing application directory contents
COPY . .

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --prefer-dist

# Install Node.js and npm
RUN curl -sL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs

# Check if npm was installed correctly
RUN npm -v

# Install npm dependencies
RUN npm install && npm run build

# Set permissions for Laravel directories
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache && \
    chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Create Database Sqlite
RUN echo "==> Create Sqlite File:" && touch /var/www/database/database.sqlite
    
# Run migrations
RUN echo "==> Migrating Database:" && php artisan migrate --force

# Expose port 9000 and start the PHP server
EXPOSE 8080
CMD ["php-fpm"]

# Check where is installed nginx
RUN which nginx

# Configure Nginx
# COPY nginx.conf /etc/nginx/sites-available/default

# Start Nginx and PHP-FPM
# CMD service nginx start && php-fpm

# Debugging step to check the contents of /var/www
# RUN echo "==> Listing contents of /var/www/public directory:" && ls -la /var/www/public
RUN echo "==> Listing contents of /var/www/database directory:" && ls -la /var/www/database
RUN echo "==> Listing contents of /var/www directory:" && ls -la /var/www
RUN echo "==> Listing contents of /var directory:" && ls -la /var
RUN echo "==> Listing contents of / directory:" && ls -la /
# RUN echo "==> Listing contents of / directory:" && ls -la /etc
# RUN echo "==> Listing contents of / directory:" && ls -la /etc/nginx
# RUN echo "==> Listing contents of / directory:" && ls -la /etc/nginx/conf.d
# RUN echo "==> Listing contents of / directory:" && ls -la /etc/nginx/sites-available

# Copy the Nginx configuration file
COPY nginx.conf /etc/nginx/nginx.conf

# Ensure Nginx can bind to privileged ports
USER root

# Add this command to test Nginx configuration
RUN echo "==> Test Nginx Configuration:" && nginx -t

# Start Nginx and PHP-FPM using a supervisor-like approach
# CMD ["sh", "-c", "service nginx start && php-fpm"]

# Use a script or supervisor to run both Nginx and PHP-FPM
# CMD ["sh", "-c", "php-fpm & nginx -g 'daemon off;'"]

# Install supervisord
#RUN apt-get update && apt-get install -y supervisor && rm -rf /var/lib/apt/lists/*

# Copy supervisord configuration
#COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# CMD to run supervisord
#CMD ["supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
