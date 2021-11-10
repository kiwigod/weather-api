FROM php:8.0-apache

# TODO: move development or production ini choice to env var
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

COPY apache2.conf /etc/apache2/apache2.conf
RUN  rm /etc/apache2/sites-available/000-default.conf

RUN a2enmod rewrite

EXPOSE 80
