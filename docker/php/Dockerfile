FROM php:8.0-fpm-buster

RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini

RUN apt-get update && apt-get install -y && apt-get install curl -y && apt-get install git -y
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install system packages for PHP extensions
RUN apt-get update \
        && apt-get -y --no-install-recommends install \
                mc \
                zip \
                git \
                ssh \
                curl \
                wget \
                bash \
                nano \
                unzip \
                libpq-dev \
                libgmp-dev \
                libicu-dev \
                zlib1g-dev \
                libxml2-dev \
                libtidy-dev \
                libmemcached-dev \
                libmagickwand-dev \
                ghostscript \
        && apt-get clean \
        && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*


# Check if Memcached extension need to be compiled
RUN git clone -b master https://github.com/php-memcached-dev/php-memcached /usr/src/php/ext/memcached \
    && docker-php-ext-configure /usr/src/php/ext/memcached \
        --disable-memcached-sasl \
    && docker-php-ext-install /usr/src/php/ext/memcached \
    && rm -rf /usr/src/php/ext/memcached

RUN apt-get update && apt-get install -y && apt-get install curl -y && apt-get install git -y

RUN apt-get update -y && apt-get install -y iproute2 && apt-get install iputils-ping -y && apt-get install -y libwebp-dev libjpeg62-turbo-dev libpng-dev libxpm-dev \
    libfreetype6-dev
RUN apt-get update && \
    apt-get install -y \
        zlib1g-dev

RUN apt-get install -y libzip-dev
RUN docker-php-ext-install zip

RUN docker-php-ext-configure gd --with-freetype --with-jpeg

RUN docker-php-ext-install gd
RUN docker-php-ext-install exif

RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

RUN apt-get update && apt-get upgrade -y \
    && apt-get install apt-utils -y \
    && apt-get install git zip vim libzip-dev libgmp-dev libffi-dev libssl-dev -y \
    && docker-php-ext-install -j$(nproc) sockets zip gmp pcntl bcmath ffi \
    && docker-php-source delete \
    && apt-get autoremove --purge -y && apt-get autoclean -y && apt-get clean -y

RUN apt update \
    && apt-get install autoconf g++ make \
    && pecl install xdebug\
    && rm -rf /tmp/pear \
    && docker-php-ext-enable xdebug

COPY ./xdebug/conf.d /usr/local/etc/php/conf.d
COPY ./xdebug/.bashrc /root/

WORKDIR /app
