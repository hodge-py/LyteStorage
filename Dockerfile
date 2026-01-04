FROM php:8.3-fpm-alpine

# Install system dependencies and PHP extensions
RUN apk add --no-cache \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    && docker-php-ext-install pdo_mysql mysqli exif


RUN echo "file_uploads = On" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "memory_limit = 256M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "upload_max_filesize = 200000000000M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "post_max_size = 2100000000000M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "max_execution_time = 600000000000000" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "max_file_uploads = 10000000" >> /usr/local/etc/php/conf.d/docker-php-ext-custom.ini \
    && echo "opcache.enable=1" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "opcache.memory_consumption=128" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "opcache.interned_strings_buffer=8" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "opcache.max_accelerated_files=4000" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "opcache.revalidate_freq=60" >> /usr/local/etc/php/conf.d/custom.ini

    
RUN sed -i 's/pm = dynamic/pm = ondemand/g' /usr/local/etc/php-fpm.d/www.conf \
    && sed -i 's/pm.max_children = 5/pm.max_children = 20/g' /usr/local/etc/php-fpm.d/www.conf \
    && sed -i 's/;pm.process_idle_timeout = 10s/pm.process_idle_timeout = 10s/g' /usr/local/etc/php-fpm.d/www.conf \
    && sed -i 's/;pm.max_requests = 500/pm.max_requests = 500/g' /usr/local/etc/php-fpm.d/www.conf \
    && sed -i 's/;request_terminate_timeout = 0/request_terminate_timeout = 600/g' /usr/local/etc/php-fpm.d/www.conf

ARG USER_ID=1000
ARG GROUP_ID=1000

RUN apk add --no-cache shadow && \
    usermod -u ${USER_ID} www-data && \
    groupmod -g ${GROUP_ID} www-data && \
    apk del shadow

WORKDIR /var/www/html

RUN mkdir -p /var/www/html/server/images && \
    chown -R www-data:www-data /var/www/html/server/images && \
    chmod -R 775 /var/www/html/server/images

EXPOSE 9000

CMD ["php-fpm"]