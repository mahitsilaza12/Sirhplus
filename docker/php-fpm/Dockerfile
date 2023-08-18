
FROM php:8.1-fpm-buster

# Set Environment Variables
ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update && apt-get install -y \
        bash \
        make \
        supervisor

#
#--------------------------------------------------------------------------
# Software's Installation
#--------------------------------------------------------------------------
#
# Installing tools and PHP extentions using "apt", "docker-php", "pecl",
#

# Install "curl", "libmemcached-dev", "libpq-dev", "libjpeg-dev",
#         "libpng-dev", "libfreetype6-dev", "libssl-dev", "libmcrypt-dev",
RUN set -eux; \
    apt-get update; \
    apt-get upgrade -y; \
    apt-get install -y --no-install-recommends \
            curl \
            libxslt-dev \
            libmemcached-dev \
            libz-dev \
            libpq-dev \
            libjpeg-dev \
            libpng-dev \
            libfreetype6-dev \
            libssl-dev \
            libwebp-dev \
            libxpm-dev \
            libmcrypt-dev \
            libzip-dev zip unzip \
            libonig-dev \
            && echo 'alias sf="php bin/console"' >> ~/.bashrc

RUN set -eux; \
    docker-php-ext-install pdo_mysql; \
    docker-php-ext-configure gd \
            --prefix=/usr \
            --with-jpeg \
            --with-freetype; \
    docker-php-ext-install gd; \
    docker-php-ext-configure zip; \
    docker-php-ext-install zip; \
    docker-php-ext-install intl; \
    docker-php-ext-install xsl; \
    docker-php-ext-install xml; \
    docker-php-ext-install simplexml; \
    php -r 'var_dump(gd_info());'

#####################################
# Composer:
#####################################
#RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
#RUN php composer-setup.php
#RUN php -r "unlink('composer-setup.php');"
#RUN mv composer.phar /usr/local/bin/composer
#RUN chmod +x /usr/local/bin/composer

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Conf PHP
COPY docker/php-fpm/docker-entrypoint.sh /usr/local/bin/docker-entrypoint

######################################
# CS Fixer
######################################
#RUN curl -L https://cs.symfony.com/download/php-cs-fixer-v3.phar -o php-cs-fixer \
#    && chmod a+x php-cs-fixer \
#    && mv php-cs-fixer /usr/local/bin/php-cs-fixer && \
#    echo "export PATH=${PATH}:${HOME}/.composer/vendor/bin" >> ~/.bashrc


######################################
# PHP MND (conflicts with local repo)
######################################
#RUN composer global require povils/phpmnd && \
#    echo "export PATH=${PATH}:${HOME}/.composer/vendor/bin" >> ~/.bashrc

USER root

# Clean up
RUN apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* && \
    rm /var/log/lastlog /var/log/faillog

# Configure non-root user.
ARG PUID=1000
ENV PUID ${PUID}
ARG PGID=1000
ENV PGID ${PGID}

RUN groupmod -o -g ${PGID} www-data && \
    usermod -o -u ${PUID} -g www-data www-data

# Configure locale.
ARG LOCALE=POSIX
ENV LC_ALL ${LOCALE}

RUN chmod +x /usr/local/bin/docker-entrypoint

WORKDIR /var/www/sirhplus
#ENTRYPOINT ["docker-entrypoint"]
CMD ["php-fpm"]

EXPOSE 9000

