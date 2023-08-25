FROM php:7.4-fpm

WORKDIR /var/www/html

# Install dependencies
RUN apt-get update && apt-get install -y \
    g++ \
    libicu-dev \
    libpq-dev \
    libzip-dev \
    zip \
    zlib1g-dev

# Install PHP extensions
RUN docker-php-ext-configure intl \
    && docker-php-ext-install intl opcache pdo pdo_mysql mysqli

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy application code and configuration
COPY . .

# Install Composer dependencies
RUN composer install --no-dev --optimize-autoloader

# Copy the example environment file
COPY .env.example .env

# Generate Laravel application key
RUN php artisan key:generate

# Expose the application port
EXPOSE 8000

# Start the application
CMD php artisan serve --host=0.0.0.0 --port=8000