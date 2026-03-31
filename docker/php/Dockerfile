FROM php:8.4-fpm

# system deps
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libzip-dev zip \
    libicu-dev curl \
    && docker-php-ext-install \
        pdo \
        pdo_pgsql \
        intl

# install Symfony CLI
RUN curl -sS https://get.symfony.com/cli/installer | bash \
    && mv /root/.symfony*/bin/symfony /usr/local/bin/symfony

# composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/app

RUN chown -R www-data:www-data /var/www/app
