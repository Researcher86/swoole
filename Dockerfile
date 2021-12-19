FROM phpswoole/swoole:4.8-php8.1

RUN set -ex \
    && pecl update-channels \
    && pecl install redis-stable xdebug \
    && docker-php-ext-enable redis \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-enable xdebug

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apt-get update && apt-get install -y htop