FROM php:7.4-apache
RUN docker-php-ext-install mysqli
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug