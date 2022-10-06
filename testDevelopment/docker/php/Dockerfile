FROM php:8.1.8-fpm-buster

COPY php.ini /usr/local/etc/php/

RUN apt-get update \
    && apt-get -y install libmcrypt-dev \
    default-mysql-client \
    zip \
    unzip \
    vim \
    zsh \
    autoconf \
    libtool \
    g++ \
    git \
    make \
    procps \
    && pecl install redis \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-enable redis \
    && curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

WORKDIR /var/www/html/laravel

COPY nvm.sh  /
RUN sh /nvm.sh

EXPOSE 9000
