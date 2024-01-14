FROM php:8.2.14-fpm

# Instale as extensões PHP e o Composer
RUN apt-get update && apt-get install -y \
    libmcrypt-dev \
    mysql-client \
    zip \
    unzip \
    git \
    curl \
    libonig-dev \
    libxml2-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    libzip-dev \
    libonig-dev \
    jpegoptim optipng pngquant gifsicle \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . /var/www

RUN composer install

CMD php artisan serve --host=0.0.0.0 --port=8080

EXPOSE 8080
