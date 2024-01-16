# Use a imagem oficial do PHP 8.3.1 com Apache
FROM php:8.3.1-apache

# Atualize o sistema e instale as dependências necessárias
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    curl \
    unzip \
    git \
    libpq-dev \
    libfcgi0ldbl \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Instale as extensões do PHP necessárias para o Laravel/Lumen
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Ative o mod_rewrite do Apache para o Laravel
RUN a2enmod rewrite

# Copie o aplicativo para o diretório /var/www
COPY . /var/www

# Defina o diretório de trabalho para /var/www
WORKDIR /var/www

# Instale o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instale as dependências do Laravel/Lumen
RUN composer install

# Dê permissão ao servidor web para escrever no diretório storage
RUN chown -R www-data:www-data /var/www/storage
RUN chmod -R 755 /var/www/storage

# Copie o arquivo de configuração do Apache para o local apropriado
COPY 000-default.conf /etc/apache2/sites-available/

# Habilite o site
RUN a2ensite 000-default

# Exponha a porta 80
EXPOSE 80

# Inicie o Apache
CMD ["apache2-foreground"]
