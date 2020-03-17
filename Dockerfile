FROM php:7.2-fpm-alpine

COPY ./config/xdebug.ini $PHP_INI_DIR/conf.d/xdebug.ini

RUN apk update \
    && apk add wget \
    && apk add curl \
    && apk add autoconf \
    && apk add gcc \
    && apk add make \
    && apk add libc-dev \
    && docker-php-ext-install mysqli pdo pdo_mysql \
    #Install composer
    && wget -O /bin/composer https://getcomposer.org/download/1.9.2/composer.phar \
    && rm -rf /var/cache/apk/* \
    && chmod o+x /bin/composer \
    #Install and setings xdebug
    && pecl install xdebug \
    #Set php.ini
    && mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini
