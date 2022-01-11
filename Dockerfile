FROM php:8.1.0-fpm

USER root

# Install dependencies
RUN apt-get update \
  && apt-get install -y \
             apt-utils \
             man \
             curl \
             git \
             bash \
             vim \
             zip unzip \
             acl \
             iproute2 \
             dnsutils \
             fonts-freefont-ttf \
             fontconfig \
             dbus \
             openssh-client \
             sendmail \
             libfreetype6-dev \
             libjpeg62-turbo-dev \
             icu-devtools \
             libicu-dev \
             libmcrypt4 \
             libmcrypt-dev \
             libpng-dev \
             zlib1g-dev \
             libxml2-dev \
             libzip-dev \
             libonig-dev \
             graphviz \
             libcurl4-openssl-dev \
             pkg-config \
             libldap2-dev \
             libpq-dev

RUN apt-get update -y \
    && apt-get install -y nginx

RUN docker-php-ext-configure intl --enable-intl && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install -j$(nproc) gd && \
    docker-php-ext-install pdo \
        pgsql pdo_pgsql \
        mysqli pdo_mysql \
        intl iconv mbstring \
        zip pcntl \
        exif opcache \
    && docker-php-source delete

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

RUN touch /run/nginx.pid \
 && chown -R www:www /run/nginx.pid

# Copy nginx configs
COPY nginx-config.conf /etc/nginx/sites-enabled/pjotus.test
COPY entrypoint.sh /etc/entrypoint.sh

# Set working directory
WORKDIR /var/www

# Copy existing application directory contents
COPY . .


# Copy existing application directory permissions
COPY --chown=www:www . .

# Change current user to www
USER root

# Expose port 9000 and start php-fpm server
EXPOSE 80 443

ENTRYPOINT ["/etc/entrypoint.sh"]