# Docker image php 7.4.*
FROM php:8-fpm
ENV PECL_REDIS_VERSION='5.3.5'
ENV LIB_RDKAFKA_VERSION='v1.8.2'

# Instalar dependências
RUN apt-get update && apt-get install -y \
    git

# Instalar extensões
RUN docker-php-ext-install mysqli pdo_mysql

RUN cd /tmp \
    && git clone --depth 1 --branch ${LIB_RDKAFKA_VERSION} https://github.com/edenhill/librdkafka.git \
    && cd librdkafka \
    && ./configure \
    && make \
    && make install

RUN pecl install redis \
    rdkafka \
    && docker-php-ext-enable redis \
    rdkafka

# Instalar composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer