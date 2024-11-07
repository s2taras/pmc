FROM php:8.2-fpm

# Install required PHP extension and dependencies
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libzip-dev \
    libonig-dev \
    unzip \
    git \
    && docker-php-ext-install intl pdo pdo_mysql zip opcache

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy existing application files
COPY src .

# Install Symfony dependicies
RUN composer install

# Set permissions for Symfony folders
RUN chown -R www-data:www-data var
RUN chmod -R 777 var