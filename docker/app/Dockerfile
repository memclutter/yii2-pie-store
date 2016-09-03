FROM php:7.0-fpm

ARG uid
ENV DEBIAN_FRONTEND noninteractive
ENV APP_ROOT /var/www/html

# Install system packages
RUN apt-get update \
 && apt-get install --no-install-recommends -yq \
        ca-certificates \
        curl \
        git \
        libmcrypt-dev \
        libpng-dev \
        unzip \
        wget

# Install php-packages
RUN docker-php-ext-install -j$(nproc) \
        gd \
        mcrypt \
        mysqli \
        pdo_mysql

# Install pecl extensions
RUN pecl install \
        redis \
 && docker-php-ext-enable redis

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install go su for simple su
RUN gpg --keyserver ha.pool.sks-keyservers.net --recv-keys B42F6819007F00F88E364FD4036A9C25BF357DD4
RUN curl -o /usr/local/bin/gosu -SL "https://github.com/tianon/gosu/releases/download/1.4/gosu-$(dpkg --print-architecture)" \
    && curl -o /usr/local/bin/gosu.asc -SL "https://github.com/tianon/gosu/releases/download/1.4/gosu-$(dpkg --print-architecture).asc" \
    && gpg --verify /usr/local/bin/gosu.asc \
    && rm /usr/local/bin/gosu.asc \
    && chmod +sx /usr/local/bin/gosu

# Install dockerize
ENV DOCKERIZE_VERSION v0.2.0
RUN wget https://github.com/jwilder/dockerize/releases/download/$DOCKERIZE_VERSION/dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && tar -C /usr/local/bin -xzvf dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz

WORKDIR ${APP_ROOT}

# Create local user with UID from host machine
RUN useradd -u ${uid} -m user
USER user
RUN composer global require "fxp/composer-asset-plugin:^1.2.0"

CMD composer install \
 && dockerize -wait tcp://${DB_HOST}:${DB_PORT} -wait tcp://${REDIS_HOST}:${REDIS_PORT} -timeout 70s \
 && php yii migrate --interactive=0 \
 && php yii faker/products 1000 \
 && gosu root php-fpm