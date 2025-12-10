# PHP 8.2 image with Apache
FROM php:8.2-apache as web

# Rendszer szintű függőségek telepítése
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    curl \
    git \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Apache mod_rewrite engedélyezése
RUN a2enmod rewrite

# PHP kiterjesztések telepítése
# JAVÍTÁS: Itt adtuk hozzá a "fileinfo"-t a hibaüzeneted miatt
RUN docker-php-ext-install pdo_mysql zip bcmath fileinfo

# Apache DocumentRoot beállítása a Laravel public mappájára
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Wait-for-it script másolása
COPY wait-for-it.sh /wait-for-it.sh
RUN chmod +x /wait-for-it.sh

# Munkakönyvtár beállítása
WORKDIR /var/www/html

# Composer fájlok másolása külön (cache miatt hatékonyabb)
COPY composer.json composer.lock /var/www/html/

# Composer telepítése
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Függőségek telepítése
# A fileinfo hiba itt már nem fog jelentkezni, mert fentebb telepítettük a modult
RUN composer install --no-autoloader --no-scripts --prefer-dist

# A maradék kód másolása
COPY . /var/www/html

# Az automatizáló script (ENTRYPOINT) másolása és futtathatóvá tétele
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Autoloader optimalizálása
RUN composer dump-autoload --optimize

# 80-as port nyitása
EXPOSE 80

# Belépési pont beállítása (ez fogja generálni a .env-t)
ENTRYPOINT ["docker-entrypoint.sh"]

# Apache indítása (ezt hívja meg a docker-entrypoint.sh a végén)
CMD ["apache2-foreground"]