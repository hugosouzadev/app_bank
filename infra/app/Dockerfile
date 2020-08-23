# Docker image php 7.4.*
FROM php:7.4-apache

# Instalar dependências
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl

# Instalar extensões
RUN docker-php-ext-install mysqli pdo_mysql

# Instalar composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copiando arquivo de configuração do apache e ativando rewrite
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

# Setar diretorio de trabalho
WORKDIR /var/www/app

CMD ["docker-php-entrypoint", "apache2-foreground"]