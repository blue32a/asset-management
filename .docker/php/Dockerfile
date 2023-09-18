FROM php:8.2-fpm-alpine

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY php.ini /usr/local/etc/php

RUN apk update \
    && apk add -U --no-cache_b \
        git \
        zip \
        unzip

RUN docker-php-ext-install pdo_mysql
