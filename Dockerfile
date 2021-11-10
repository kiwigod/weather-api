FROM php:8.0-apache

# TODO: move development or production ini choice to env var
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"
RUN a2enmod rewrite

COPY . /var/www

ADD ./.docker-vhost.conf /etc/apache2/sites-enabled/000-default.conf
ADD ./.opcache.ini /usr/local/etc/php/conf.d/opcache.ini

EXPOSE 80
