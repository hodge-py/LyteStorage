# Dockerfile

# 1. Start from the base image you specified in docker-compose.yml
FROM php:8.3-apache 

# 2. Install the pdo_mysql extension
# This is the line that fixes your 'could not find driver' error
RUN docker-php-ext-install pdo_mysql

RUN echo "file_uploads = On" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "memory_limit = 25600000000M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "upload_max_filesize = 200000000000M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "post_max_size = 2100000000000M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "max_execution_time = 6000000000000" >> /usr/local/etc/php/conf.d/uploads.ini

RUN echo "max_file_uploads = 10000000000" >> /usr/local/etc/php/conf.d/uploads.ini
# 3. (Optional but Recommended) Install mysqli as well, as some older PHP code relies on it
RUN docker-php-ext-install mysqli

# 4. Set the working directory (already done by the base image, but good practice)
# WORKDIR /var/www/html 

# Note: We do NOT need a COPY command here, because the volume in 
# docker-compose.yml will handle mounting your local code.