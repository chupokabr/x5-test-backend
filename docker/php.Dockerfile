FROM composer:latest AS composer

FROM php:7.4-apache

RUN apt-get update && apt-get install -y --no-install-recommends \
    curl \
    git \
    g++ \
    libbz2-dev \
    libfreetype6-dev \
    libicu-dev \
    libjpeg-dev \
    libmcrypt-dev \
    libpng-dev \
    libreadline-dev \
    libpq-dev \
    libzip-dev \
	zip \
    unzip \
 && rm -rf /var/lib/apt/lists/*

ENV APP_HOME /var/www/html
ENV APACHE_DOCUMENT_ROOT=${APP_HOME}/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

#mod_rewrite for URL rewrite and mod_headers for .htaccess extra headers like Access-Control-Allow-Origin-
RUN a2enmod rewrite headers


RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
 && docker-php-ext-install \
    bcmath \
    bz2 \
    calendar \
    iconv \
    intl \
    opcache \
    pdo_pgsql \
    zip

# Composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

COPY . $APP_HOME

RUN composer install --no-dev --prefer-dist --optimize-autoloader

RUN chown -R www-data:www-data $APP_HOME




