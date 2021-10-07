FROM php:8.0-fpm-buster AS base
RUN apt-get update && apt-get install -y zlib1g-dev git zip default-mysql-client && \
    docker-php-ext-install pdo_mysql opcache && \
    pecl install redis && \
    docker-php-ext-enable redis && \
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer

FROM base AS local
RUN pecl install xdebug && \
    docker-php-ext-enable xdebug

FROM base AS remote
WORKDIR /var/www/html/
COPY . .
RUN composer install -n --prefer-dist
RUN chmod -R 777 storage
