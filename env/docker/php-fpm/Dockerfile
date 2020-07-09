ARG PHP_VERSION=${PHP_VERSION}

FROM php:${PHP_VERSION}-fpm

# Install packages for required extensions
RUN apt-get update \
  && apt-get install -y --no-install-recommends \
    libzip-dev \
    libz-dev \
    libpq-dev \
    libssl-dev \
    libmcrypt-dev \
    libicu-dev \
    libxml2-dev \
    curl \
    iputils-ping \
    vim \
    libonig-dev \
  && rm -rf /var/lib/apt/lists/*

# Install Laravel required extensions
RUN docker-php-ext-install json && \
    docker-php-ext-install mbstring && \
    docker-php-ext-install xml && \
    docker-php-ext-install ctype && \
    docker-php-ext-install tokenizer && \
    docker-php-ext-install pdo_pgsql && \
    docker-php-ext-install opcache && \
    docker-php-ext-install zip && \
    docker-php-ext-configure intl && docker-php-ext-install intl && \
    docker-php-ext-install bcmath && \
    docker-php-ext-install sockets

# Install required PECL extensions
RUN pecl install \
    redis

# Enable above
RUN docker-php-ext-enable \
    redis

###########################################################################
# xDebug:
###########################################################################

ARG PHP_XDEBUG_ENABLE=false
ARG PHP_XDEBUG_VERSION=
RUN if [ ${PHP_XDEBUG_ENABLE} = true ]; then \
    # Install the xdebug extension
    # when php is 7.3, xdebug version has to be xdebug-2.7.0
    pecl install "xdebug${PHP_XDEBUG_VERSION}" && \
    docker-php-ext-enable xdebug \
;fi

# Copy xdebug configuration for remote debugging
COPY ./xdebug.ini /usr/local/etc/php/conf.d/

ARG PHP_XDEBUG_REMOTE_CONNECT_BACK=false
RUN if [ ${PHP_XDEBUG_REMOTE_CONNECT_BACK} = true ]; then \
    echo "xdebug.remote_connect_back=1" >> /usr/local/etc/php/conf.d/xdebug.ini \
;fi

###########################################################################
# Check PHP version:
###########################################################################

ARG PHP_VERSION=${PHP_VERSION}

RUN php -v | head -n 1 | grep -q "PHP ${PHP_VERSION}."

###########################################################################
# Copy PHP configuration files
###########################################################################

COPY ./php.ini /usr/local/etc/php/
COPY ./opcache.ini /usr/local/etc/php/conf.d/
COPY ./laravel.ini /usr/local/etc/php/conf.d/
COPY ./xlaravel.pool.conf /usr/local/etc/php-fpm.d/

USER root

###########################################################################
# Clean up
###########################################################################

RUN apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* && \
    rm /var/log/lastlog /var/log/faillog

RUN usermod -u 1000 www-data

WORKDIR /var/www
