FROM php:7.4.33-fpm

## Create the www-data user and group
#RUN groupadd -g 82 -r www-data && useradd -u 82 -r -g www-data www-data

# Install GD extension
RUN apt-get update && \
    apt-get install -y \
        git \
        unzip \
        libzip-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        p7zip-full



# Install PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql bcmath zip
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install -j$(nproc) gd
RUN docker-php-ext-enable mysqli pdo pdo_mysql bcmath zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy the Laravel application into the Docker image
COPY . /var/www/html

# Change the permissions of the storage directory
RUN chown -R www-data:www-data /var/www/html/storage && chmod -R 775 /var/www/html/storage

