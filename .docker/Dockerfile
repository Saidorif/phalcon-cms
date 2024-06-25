FROM php:7.4-apache

RUN apt update

RUN apt install -y \
    apt-transport-https \
    lsb-release \
    ca-certificates \
    wget \
    curl \
    nano \
    dialog \
    net-tools \
    git \
    sudo \
    openssl \
    libpcre3-dev \
    software-properties-common

# Install the PDO MySQL driver
RUN docker-php-ext-install pdo_mysql

# Install the PSR extension from source
RUN git clone https://github.com/jbboehr/php-psr.git \
    && cd php-psr \
    && phpize \
    && ./configure \
    && make \
    && make test \
    && make install \
    && echo extension=psr.so > /usr/local/etc/php/conf.d/psr.ini

# Install the Phalcon extension from source
RUN curl -LO https://github.com/phalcon/cphalcon/archive/v4.1.0.tar.gz \
    && tar xzf v4.1.0.tar.gz \
    && cd cphalcon-4.1.0/build \
    && ./install \
    && echo extension=phalcon.so > /usr/local/etc/php/conf.d/phalcon.ini

RUN a2enmod rewrite