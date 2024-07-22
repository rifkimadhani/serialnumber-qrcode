FROM php:8.3-fpm-bullseye

WORKDIR /var/www/html

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
    imagemagick \
    libmagickwand-dev \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl \
    && docker-php-ext-enable pdo pdo_mysql mbstring zip exif pcntl \
    && docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-enable gd

# Install imagick
RUN cd /tmp \
    && curl -O https://pecl.php.net/get/imagick-3.7.0.tgz \
    && tar -xzf imagick-3.7.0.tgz \
    && cd imagick-3.7.0 \
    && phpize \
    && ./configure \
    && make \
    && make install \
    && echo "extension=imagick.so" > /usr/local/etc/php/conf.d/imagick.ini

# Install Composer
COPY --from=composer:2.7.6 /usr/bin/composer /usr/bin/composer

# Install Node.js and npm
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Copy application files
COPY . .

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Install PHP dependencies
RUN composer install --no-dev --prefer-dist

RUN composer require maatwebsite/excel
RUN composer require simplesoftwareio/simple-qrcode
RUN composer require barryvdh/laravel-dompdf
RUN composer require laravel/breeze --dev

# Install NPM dependencies and build assets
RUN npm install \
    && npm run build

# Run migrations
# RUN php artisan migrate:fresh --seed

# Create symbolic link for storage
RUN php artisan storage:link

# Change current user to www-data
USER www-data

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
