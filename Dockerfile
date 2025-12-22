FROM php:8.3-fpm-alpine

# Install system dependencies and PHP extensions
RUN apk add --no-cache \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    && docker-php-ext-install pdo_mysql mysqli exif

# Set performance limits (optimized for 2GB RAM)
RUN echo "file_uploads = On" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "memory_limit = 25600000000M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "upload_max_filesize = 200000000000M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "post_max_size = 2100000000000M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "max_execution_time = 6000000000000" >> /usr/local/etc/php/conf.d/uploads.ini

WORKDIR /var/www/html

EXPOSE 9000

CMD ["php-fpm"]