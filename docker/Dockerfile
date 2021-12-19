FROM php:7.4-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y git

RUN apt install -y zip unzip libzip-dev

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql zip

#Xdebug no puedo vivir sin ti, no hay manera
RUN pecl install -f xdebug \
&& docker-php-ext-enable xdebug

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install php_cs
RUN curl -OL https://squizlabs.github.io/PHP_CodeSniffer/phpcs.phar \
    && chmod a+x phpcs.phar \
    && mv phpcs.phar /usr/local/bin/php_cs

# Install php_cs_fixer
RUN curl -OL https://cs.symfony.com/download/php-cs-fixer-v3.phar \
    && chmod a+x php-cs-fixer-v3.phar \
    && mv php-cs-fixer-v3.phar /usr/local/bin/php-cs-fixer

# Set working directory
WORKDIR /var/www
