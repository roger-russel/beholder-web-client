FROM php:5.6-apache
MAINTAINER Roger Russel <rrussel@allin.com.br>

ENV TERM=xterm
RUN locale

WORKDIR /var/www

RUN ln -s /var/www/vendor/bin/codecept /usr/bin/

RUN apt-get update && apt-get install -y \
  git \
  zip \
  unzip \
  build-essential \
  && rm -rf /var/lib/apt/lists/*

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN php -r "unlink('composer-setup.php');"

# Install PHP Modules
RUN docker-php-ext-install \
  pdo \
  pdo_mysql \
  mysqli
