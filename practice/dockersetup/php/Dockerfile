FROM php:8.3-fpm

# Set working directory
WORKDIR /var/www/html

ENV PHP_OPCACHE_VALIDATE_TIMESTAMPS="1" \
    PHP_OPCACHE_MAX_ACCELERATED_FILES="10000" \
    PHP_OPCACHE_MEMORY_CONSUMPTION="192" \
    PHP_OPCACHE_MAX_WASTED_PERCENTAGE="10"

# Install necessary dependencies
#RUN apt-get update && apt-get install -y libpq-dev supervisor \
RUN apt-get update && apt-get install -y libpq-dev zip unzip \
    && pecl install redis \
    && docker-php-ext-install pdo pdo_pgsql sockets opcache \
    && docker-php-ext-enable redis

#RUN mkdir -p /var/log/supervisor
#COPY docker/supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# install composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN curl -sSLf \
        -o /usr/local/bin/install-php-extensions \
        https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions && \
    chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions php/pecl-networking-gearman@gearman-2.1.2

COPY docker/php/conf.d/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

#CMD ["/usr/bin/supervisord"]
