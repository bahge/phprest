FROM php:7.4.3-apache

RUN a2enmod rewrite

RUN apt-get update \
 && apt install -y --no-install-recommends \
    curl \
    openssl \
    nano \
    net-tools \
    iputils-ping \
    git

RUN apt install -y zip libzip-dev
RUN docker-php-ext-configure zip
RUN docker-php-ext-install zip

RUN docker-php-ext-install \
    mysqli \
    pdo \
    pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY ./public/composer.json /var/www/html/composer.json

RUN cd /var/www/html/ && composer update