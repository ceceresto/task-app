FROM dunglas/frankenphp

# Install system packages
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl

# Install PHP extensions
RUN install-php-extensions \
    pdo_pgsql \
    redis \
    pcntl \
    bcmath

# Copy Composer from official Composer image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Cache Laravel config
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

EXPOSE 8000

CMD ["php", "artisan", "octane:start", "--server=frankenphp", "--host=0.0.0.0", "--port=8080"]