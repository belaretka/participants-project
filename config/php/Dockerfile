FROM php:8.1-fpm

RUN apt-get update
RUN apt-get install -y curl git

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www/public_html

ENTRYPOINT [ "php-fpm" ]