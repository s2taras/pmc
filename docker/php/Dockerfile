FROM php:8.3-fpm

# Set working directory
WORKDIR /var/www/html

# Install necessary dependencies
#RUN apt-get update && apt-get install -y libpq-dev supervisor \
RUN apt-get update && apt-get install -y libpq-dev zip unzip \
    && docker-php-ext-install pdo pdo_pgsql sockets

#RUN mkdir -p /var/log/supervisor
#COPY docker/supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# install composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN curl -sSLf \
        -o /usr/local/bin/install-php-extensions \
        https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions && \
    chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions php/pecl-networking-gearman@gearman-2.1.2

#CMD ["/usr/bin/supervisord"]
