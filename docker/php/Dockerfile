FROM php:8.4-fpm

# Set working directory
WORKDIR /var/www/html

# Install necessary dependencies
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Update PHP-FPM to listen on 127.0.0.1:9001
RUN #sed -i 's/listen = 127.0.0.1:9000/listen = 9001/' /usr/local/etc/php-fpm.d/www.conf
RUN #sed -i 's/listen = 127.0.0.1:9000/listen = 9001/' /usr/local/etc/php-fpm.d/www.conf.default
RUN #sed -i 's/listen = 9000/listen = 9001/' /usr/local/etc/php-fpm.d/zz-docker.conf

# Copy application filesphp-fpm -tt
COPY ./src /var/www/html

# Set permissions
RUN chown -R www-data:www-data /var/www/html

# Expose PHP-FPM port
#EXPOSE 9001

# Start PHP-FPM
CMD ["php-fpm"]