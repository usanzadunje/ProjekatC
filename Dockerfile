# !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
# !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
# !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
#NEEDS CHANGE TO USE SUPERVISOR FOR QUEUE AND OTHER STULL

FROM php:8.0-fpm

LABEL maintainer="Dusan Djordjevic"

ARG NODE_VERSION=16

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install system dependencies
RUN apt-get update && apt-get install -y git curl zip unzip supervisor libpng-dev libjpeg62-turbo-dev libzip-dev libicu-dev \
    && curl -sL https://deb.nodesource.com/setup_$NODE_VERSION.x | bash - \
    && apt-get install -y nodejs \
    && apt-get update \
    && docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo_mysql zip bcmath intl opcache \
    && docker-php-ext-enable gd pdo_mysql zip bcmath intl opcache \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN groupadd -g 1000 www && useradd -u 1000 -ms /bin/bash -g www www

COPY ./docker-compose/php/php.ini /etc/php/8.0/cli/conf.d/app.ini
COPY ./docker-compose/supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
RUN chmod +x /var/www/docker-compose/init.sh

USER www

ENTRYPOINT ["/var/www/docker-compose/init.sh"]