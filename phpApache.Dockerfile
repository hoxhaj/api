FROM php:7.4-apache

# Update
RUN apt-get update

# Install extensions
RUN docker-php-ext-install pdo pdo_mysql

# Apache directive
RUN a2enmod rewrite

EXPOSE 80