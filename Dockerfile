FROM php:8.3-fpm-bullseye

WORKDIR /var/www

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libzip-dev \
    libonig-dev \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl \
    && docker-php-ext-enable pdo_mysql mbstring zip exif pcntl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-enable gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy existing application directory contents
COPY . .
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage \
    && chmod -R 775 /var/www/bootstrap/cache

RUN chown -R www-data:www-data /var/www/vendor \
    && chmod -R 775 /var/www/vendor

RUN composer install --no-dev --prefer-dist

# Copy existing application directory permissions
COPY --chown=www-data:www-data . /var/www

# Change current user to www-data
USER www-data

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
