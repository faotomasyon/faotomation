FROM php:7.3.28-apache

RUN apt-get update && \
    apt-get install -y git zlib1g-dev libfreetype6-dev libjpeg62-turbo-dev libpng-dev libzip-dev vim libxml2-dev

COPY 80.conf /etc/apache2/sites-available/000-default.conf

RUN docker-php-ext-install pdo pdo_mysql zip mbstring

WORKDIR /var/www/html

RUN a2enmod rewrite
RUN service apache2 restart