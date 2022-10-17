FROM php:8.1-alpine

RUN mv /usr/local/etc/php/php.ini-development "$PHP_INI_DIR/php.ini"
RUN sed -i "s/memory_limit = 128M/memory_limit = -1/g" /usr/local/etc/php/php.ini

RUN docker-php-ext-install pdo pdo_mysql

#Install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && php composer-setup.php --install-dir=/usr/local/bin --filename=composer

RUN mkdir -p /var/www/html

EXPOSE 8000

WORKDIR /var/www/html
