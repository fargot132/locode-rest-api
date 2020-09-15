FROM php:7.4-fpm-alpine

# Install packeges
RUN apk --update --no-cache add git bash libzip-dev

# Install extensions
RUN docker-php-ext-install pdo_mysql zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Symfony
RUN curl -sS https://get.symfony.com/cli/installer | bash && \
    mv /root/.symfony/bin/symfony /usr/local/bin/symfony

COPY ./symfony /var/www/symfony

