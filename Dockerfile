FROM php:8.2.25-apache
WORKDIR /var/www/html
RUN apt-get update && apt-get install -y libmariadb-dev
RUN docker-php-ext-install mysqli