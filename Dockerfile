# Use the official PHP image as base image
FROM php:latest

# Install required dependencies
RUN apt-get update && \
    apt-get install -y --no-install-recommends \
    libzip-dev \
    unzip \
    && docker-php-ext-install zip pdo_mysql

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the working directory to /app
WORKDIR /app

# Copy composer files and install dependencies
COPY composer.json composer.lock /app/
RUN composer install --no-dev

# Copy the rest of the application code
COPY . /app

# Expose port 8000 for Laravel application
EXPOSE 8000

# Set environment variables
ENV APP_KEY=your_generated_app_key \
    DB_CONNECTION=mysql \
    DB_HOST=laravel \
    DB_PORT=3306 \
    DB_DATABASE=laravel \
    DB_USERNAME=laravel_user \
    DB_PASSWORD=your_generated_password \
    PORT=8000

# Command to start the Laravel application
CMD ["php", "artisan", "serve", "--host", "0.0.0.0", "--port", "$PORT"]
