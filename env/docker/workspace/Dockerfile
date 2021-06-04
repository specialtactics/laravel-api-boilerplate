ARG PHP_VERSION=${PHP_VERSION}

FROM php:${PHP_VERSION}-cli

RUN echo "nameserver 8.8.8.8" >> /etc/resolv.conf

# Install packages for required extensions
RUN apt-get update \
  && apt-get install -y --no-install-recommends \
    libz-dev \
    libpq-dev \
    libssl-dev \
    libmcrypt-dev \
    libicu-dev \
    libxml2-dev \
    curl \
    git \
    zip \
    unzip \
    libzip-dev \
    vim \
    nano \
    wget \
    zsh \
    ruby \
    ruby-dev \
    ruby-bundler \
    ssh-client \
    iputils-ping \
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
# Laradock non-root user:
###########################################################################

# Start as root
USER root

# Add a non-root user to prevent files being created with root permissions on host machine.
ARG PUID=1000
ENV PUID ${PUID}
ARG PGID=1000
ENV PGID ${PGID}

RUN groupadd -g ${PGID} laradock && \
    useradd -u ${PUID} -g laradock -m laradock && \
    usermod -p "*" laradock

###########################################################################
# Set Timezone
###########################################################################

ARG TZ=UTC
ENV TZ ${TZ}

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

###########################################################################
# User Aliases
###########################################################################

USER root

COPY ./aliases.sh /root/aliases.sh
COPY ./aliases.sh /home/laradock/aliases.sh

RUN sed -i 's/\r//' /root/aliases.sh && \
    sed -i 's/\r//' /home/laradock/aliases.sh && \
    chown laradock:laradock /home/laradock/aliases.sh && \
    echo "" >> ~/.bashrc && \
    echo "# Load Custom Aliases" >> ~/.bashrc && \
    echo "source ~/aliases.sh" >> ~/.bashrc && \
	echo "" >> ~/.bashrc

USER laradock

RUN echo "" >> ~/.bashrc && \
    echo "# Load Custom Aliases" >> ~/.bashrc && \
    echo "source ~/aliases.sh" >> ~/.bashrc && \
	echo "" >> ~/.bashrc

###########################################################################
# Composer:
###########################################################################

USER root

ARG COMPOSER_PROCESS_TIMEOUT=300
ENV COMPOSER_PROCESS_TIMEOUT ${COMPOSER_PROCESS_TIMEOUT}

# Install composer and add its bin to the PATH.
RUN curl -s http://getcomposer.org/installer | php && \
    echo "export PATH=${PATH}:/var/www/vendor/bin" >> ~/.bashrc && \
    mv composer.phar /usr/local/bin/composer

USER laradock

# Export composer vendor path
RUN echo "" >> ~/.bashrc && \
    echo 'export PATH="~/.composer/vendor/bin:$PATH"' >> ~/.bashrc

###########################################################################
# Non-root user : PHPUnit path
###########################################################################

# add ./vendor/bin to non-root user's bashrc (needed for phpunit)
USER laradock
RUN echo "" >> ~/.bashrc && \
    echo 'export PATH="/var/www/vendor/bin:$PATH"' >> ~/.bashrc

###########################################################################
# Crontab
###########################################################################

USER root
COPY ./crontab /etc/cron.d
RUN chmod -R 644 /etc/cron.d

#####################################
# Oh My ZSH
#####################################

USER root
RUN wget https://github.com/robbyrussell/oh-my-zsh/raw/master/tools/install.sh -O - | zsh || true \
    && chsh -s $(which zsh) $(whoami) \
    && chsh -s $(which zsh) laradock
COPY ./.zshrc /home/laradock/zshrc

USER laradock
RUN wget https://github.com/robbyrussell/oh-my-zsh/raw/master/tools/install.sh -O - | zsh || true \
    mv ~/zshrc ~/.zshrc

###########################################################################
# xDebug:
###########################################################################

USER root
ARG PHP_XDEBUG_ENABLE=false
ARG PHP_XDEBUG_VERSION=
RUN if [ ${PHP_XDEBUG_ENABLE} = true ]; then \
    # Install the xdebug extension
    # when php is 7.3, xdebug version has to be xdebug-2.7.0
    pecl install xdebug${PHP_XDEBUG_VERSION} && \
    docker-php-ext-enable xdebug \
;fi

# Copy xdebug configuration for remote debugging
COPY ./xdebug.ini /usr/local/etc/php/conf.d/

ARG PHP_XDEBUG_REMOTE_CONNECT_BACK=false
RUN if [ ${PHP_XDEBUG_REMOTE_CONNECT_BACK} = true ]; then \
    echo "xdebug.remote_connect_back=1" >> /usr/local/etc/php/conf.d/xdebug.ini \
;fi

#####################################
# RVM, Ruby, and Bundler Installation
#####################################

# Install Ruby & Apiary CLI tool
USER root
RUN echo $(ruby -v) && \
    gem update --system && \
    gem install bundler && \
    gem install apiaryio


###########################################################################
# Check PHP version:
###########################################################################

ARG PHP_VERSION=${PHP_VERSION}
RUN php -v | head -n 1 | grep -q "PHP ${PHP_VERSION}."

#
#--------------------------------------------------------------------------
# Final Touch
#--------------------------------------------------------------------------
#

USER root

RUN mkdir /home/laradock/.config && chown laradock:laradock /home/laradock/.config

# Clean up
RUN apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* && \
    rm /var/log/lastlog /var/log/faillog

# Set default work directory
WORKDIR /var/www
