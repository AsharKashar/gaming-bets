FROM php:7.4-fpm
MAINTAINER Kenan Duman <kenanduman1988@gmail.com>

# Changing Workdir
WORKDIR /application

# Install dependencies for laravel
RUN apt-get update && \
  apt-get install --no-install-recommends -y \
  apt-utils \
  build-essential \
  default-mysql-client \
  mariadb-client \
  libonig-dev \
  libpng-dev \
  libzip-dev \
  libjpeg62-turbo-dev \
  libfreetype6-dev \
  locales \
  zip \
  jpegoptim optipng pngquant gifsicle \
  vim \
  unzip \
  git \
  curl \
  graphviz \
  bash \
  procps \
  openssh-client && \
  rm -rf /var/lib/apt/lists/*

# Clear cache
# Clean after install
RUN apt-get autoremove -y && apt-get clean

# Install extensions
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd

# GMP install for SteamID
RUN apt-get update && apt-get install -y libgmp-dev re2c libmhash-dev libmcrypt-dev file
RUN ln -s /usr/include/x86_64-linux-gnu/gmp.h /usr/local/include/
RUN docker-php-ext-configure gmp
RUN docker-php-ext-install gmp

# Install redis
RUN pecl install redis && docker-php-ext-enable redis

# Install composer
RUN curl -sS https://getcomposer.org/installer | php && \
  mv composer.phar /usr/local/bin/composer

# Install Prestissimo globally for faster Composer install
RUN composer global require hirak/prestissimo --no-plugins --no-scripts

COPY entrypoint.sh /usr/local/bin/

# this fix working with docker-machine on mac
RUN usermod -u 1000 www-data
RUN usermod -G staff www-data

# Expose port 9000
EXPOSE 9000


ENTRYPOINT ["entrypoint.sh"]
CMD ["php-fpm"]
