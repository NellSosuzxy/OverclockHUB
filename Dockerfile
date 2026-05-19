FROM php:8.2-fpm

WORKDIR /var/www

# Fix: Install curl and gnupg first
RUN apt-get update && apt-get install -y \
    curl \
    gnupg \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo_mysql \
    && curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

