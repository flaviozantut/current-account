FROM php:7.4-fpm

RUN apt-get update \
    && apt-get install -y git \
    && apt-get install -y libzip-dev \
    && pecl install -o -f redis-5.3.1

RUN docker-php-ext-install pdo_mysql zip \
    && docker-php-ext-enable redis

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"\
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/local/bin/composer
