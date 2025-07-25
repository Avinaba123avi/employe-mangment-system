FROM php:8.2-fpm

RUN apt-get update && apt-get install -y libpq-dev libzip-dev \
    && docker-php-ext-install pdo_pgsql zip

COPY . /var/www/html
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

WORKDIR /var/www/html
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install --no-dev --optimize-autoloader

EXPOSE 9000
CMD ["php-fpm"]