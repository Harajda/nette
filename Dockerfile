FROM php:8.1-apache

# Inštalácia závislostí
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git \
    && docker-php-ext-install pdo pdo_mysql \
    && docker-php-ext-install zip

# Inštalácia Composeru
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Nastavenie pracovného adresára
WORKDIR /var/www/html

# Nastavenie práv a vlastníctva
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Nastavenie dokumentového koreňa
ENV APACHE_DOCUMENT_ROOT /var/www/html/www

# Kopírovanie Apache konfiguračného súboru
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

# Povolenie .htaccess
RUN a2enmod rewrite

# Vytvorenie temp adresára s požadovanými právami
RUN mkdir -p /var/www/html/temp/cache \
    && chown -R www-data:www-data /var/www/html/temp \
    && chmod -R 755 /var/www/html/temp