# Docker image php 7.4.*
FROM php:8-fpm
ENV PECL_REDIS_VERSION='5.3.5'

# Instalar dependências
RUN apt-get update && apt-get install -y \
    git

# Instalar extensões
RUN docker-php-ext-install mysqli pdo_mysql

RUN pecl install redis-${PECL_REDIS_VERSION} \
    && docker-php-ext-enable redis

# Instalar composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer