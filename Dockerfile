FROM php:7.2-fpm-alpine

COPY ./config/php.ini $PHP_INI_DIR/conf.d/php.ini

RUN apk update \
    && apk add wget \
    && apk add curl \
    && apk add autoconf \
    && apk add gcc \
    && apk add make \
    && apk add libc-dev \
    && docker-php-ext-install mysqli pdo pdo_mysql \
    #Set development php
    && mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini \ 
    #Install composer
    && wget -O /bin/composer https://getcomposer.org/download/1.9.2/composer.phar \
    && rm -rf /var/cache/apk/* \
    && chmod o+x /bin/composer \
    #Install and setings xdebug
    && pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > $PHP_INI_DIR/conf.d/php.ini \
    #Install and setings phalcon
    && pecl install phalcon \
    && echo "extension=psr.so" >> $PHP_INI_DIR/php.ini \
    && echo "extension=phalcon.so" >> $PHP_INI_DIR/php.ini 
