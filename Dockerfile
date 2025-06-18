FROM php:8.2-apache

# Install ekstensi PHP yang diperlukan
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libicu-dev \
    libsqlite3-dev

# Install ekstensi PHP
RUN docker-php-ext-install \
    intl \
    mysqli \
    pdo \
    pdo_mysql \
    pdo_sqlite

# Test


# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Aktifkan mod_rewrite Apache
RUN a2enmod rewrite

# Copy source code ke folder kerja container
COPY . /var/www/html/

# Buat folder writable yang diperlukan dan atur permission dan ownership-nya
RUN mkdir -p /var/www/html/writable/database /var/www/html/writable/cache /var/www/html/writable/session /var/www/html/writable/logs /var/www/html/writable/uploads /var/www/html/writable/debugbar && \
    touch /var/www/html/writable/database/db.sqlite && \
    chown -R www-data:www-data /var/www/html/writable && \
    chmod -R 775 /var/www/html/writable

RUN mkdir -p /var/www/html/public/uploads && \
    chown -R www-data:www-data /var/www/html/public/uploads && \
    chmod -R 775 /var/www/html/public/uploads

# Install dependencies composer tanpa dev dan optimasi autoloader
RUN composer install --no-dev --optimize-autoloader

# Ubah document root Apache ke folder public di CI4
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# RUN php /var/www/html/spark migrate

# Sesuaikan konfigurasi Apache untuk document root
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Pastikan ownership dan permission agar Apache dapat akses penuh
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 775 /var/www/html/writable

EXPOSE 80