FROM php:8.3-fpm

COPY docker/php/php.ini /usr/local/etc/php/conf.d/docker-php-config.ini

RUN docker-php-ext-install \
    pdo pdo_mysql

WORKDIR /var/www/promofarma
