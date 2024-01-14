# Use a imagem oficial do PHP 8.3 com Apache
FROM php:8.3-apache

# Atualize a lista de pacotes e instale as dependências necessárias
RUN apt-get update && apt-get install -y \
    libmcrypt-dev \
    libzip-dev \
    libonig-dev \
    zip \
    unzip \
    git \
    curl

# Instale as extensões PHP necessárias
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath

# Instale o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Defina o diretório de trabalho
WORKDIR /var/www

# Copie o aplicativo para o contêiner
COPY . /var/www

# Instale as dependências do Composer
RUN composer install

# Exponha a porta 80 e inicie o servidor Apache
EXPOSE 80
CMD ["apache2-foreground"]
