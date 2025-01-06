# Use the official PHP image with Apache
FROM php:8.2-apache

# Set working directory
WORKDIR /var/www/html

# Install required packages and PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    default-mysql-client \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Enable Apache mod_rewrite for Laravel
RUN a2enmod rewrite

# Install MySQL server
RUN apt-get update && apt-get install -y mysql-server

# Expose MySQL port
EXPOSE 3306

# Copy Laravel application files
COPY ./hallbooking /var/www/html

# Set permissions for Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Set MySQL root password and create a Laravel database
RUN service mysql start \
    && mysql -u root -e "CREATE DATABASE laravel;" \
    && mysql -u root -e "ALTER USER 'root'@'localhost' IDENTIFIED BY 'root';" \
    && mysql -u root -prootpassword -e "FLUSH PRIVILEGES;"

# Run both Apache and MySQL when the container starts
CMD service mysql start && apache2-foreground
