FROM php:5.6
MAINTAINER Roger Russel <rrussel@allin.com.br>

ENV TERM=xterm
RUN locale

WORKDIR /var/www

RUN ln -s /var/www/vendor/bin/codecept /usr/bin/

RUN apt-get update && apt-get install -y \
  git \
  zip \
  unzip \
  libyaml-dev \
  libpq-dev \
  build-essential \
  whois \
  zlib1g-dev \
  && rm -rf /var/lib/apt/lists/*

RUN yes '' | pecl install yaml-1.3.1

RUN pecl install xdebug \
  && docker-php-ext-enable xdebug

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN php -r "unlink('composer-setup.php');"

RUN docker-php-ext-configure \
  pgsql -with-pgsql=/usr/local/pgsql

# Install PHP Modules
RUN docker-php-ext-install \
  pdo \
  pdo_mysql \
  mysqli \
  pdo_pgsql \
  zip

CMD ["php", "-S", "localhost:80", "-t", "tests/acceptance/fixtures"]
