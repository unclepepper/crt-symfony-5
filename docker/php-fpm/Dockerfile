FROM php:8.0-fpm-alpine as php

RUN set -xe \
    && apk add --no-cache \
       shadow \
       libzip-dev \
       libintl \
       icu \
       icu-dev \
       bash \
       curl \
       libmcrypt \
       libmcrypt-dev \
       libxml2-dev \
       postgresql-dev \
       pcre-dev \
       git \
       g++ \
       make \
       autoconf \
       openssh \
       util-linux-dev \
       libuuid \
       sqlite-dev\
       rabbitmq-c-dev
RUN docker-php-ext-install -j$(nproc) \
        intl \
        soap \
        sockets \
        opcache \
        pcntl \
        sockets \
        exif \
        pdo_pgsql


RUN pecl update-channels && \
    pecl install uuid && \
    docker-php-ext-enable uuid && \
    pecl install pcov && \
    docker-php-ext-enable pcov
RUN pecl install amqp && \
        docker-php-ext-enable amqp


RUN apk add gnu-libiconv --no-cache --repository http://dl-cdn.alpinelinux.org/alpine/edge/community/ --allow-untrusted
ENV LD_PRELOAD /usr/lib/preloadable_libiconv.so php
    

COPY --from=composer /usr/bin/composer /usr/bin/composer


EXPOSE 9000
WORKDIR /var/www/
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_MEMORY_LIMIT=-1

ARG PUID=1000
ENV PUID ${PUID}
ARG PGID=1000
ENV PGID ${PGID}

RUN usermod -u ${PUID} www-data && groupmod -g ${PGID} www-data
RUN mkdir -p /var/www/ && chown -R www-data:www-data /var/www/

RUN echo 'memory_limit=1536M' > /usr/local/etc/php/conf.d/memory.ini
RUN echo 'upload_max_filesize = 10M' > /usr/local/etc/php/conf.d/upload-size.ini
RUN echo 'post_max_size = 10M' >> /usr/local/etc/php/conf.d/upload-size.ini

USER ${PUID}:${PGID}
