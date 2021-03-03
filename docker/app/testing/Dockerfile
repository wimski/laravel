FROM php:7.4-fpm-alpine

WORKDIR /var/www/html

RUN apk add --no-cache --virtual .build-deps \
        $PHPIZE_DEPS \
        imagemagick-dev \
        libpng-dev \
        libtool \
        libxml2-dev \
        oniguruma-dev \
    && apk add --no-cache \
    	git \
    	imagemagick \
        libzip-dev \
    	mysql-client \
        jpeg-dev \
    	shadow \
    && pecl install \
        imagick \
        pcov \
    && docker-php-ext-enable \
        imagick \
        pcov \
    && docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install \
        bcmath \
        gd \
        mbstring \
        pdo \
        pdo_mysql \
        tokenizer \
        xml \
        zip \
    && rm -rf /tmp/pear \
    && curl -s https://getcomposer.org/installer | \
        php -- --install-dir=/usr/local/bin/ --filename=composer \
    && apk del -f .build-deps

RUN set -eux; \
        docker-php-ext-enable opcache; \
        { \
            echo 'opcache.memory_consumption=128'; \
            echo 'opcache.interned_strings_buffer=8'; \
            echo 'opcache.max_accelerated_files=4000'; \
            echo 'opcache.revalidate_freq=2'; \
            echo 'opcache.fast_shutdown=1'; \
            echo 'upload_max_filesize=128M'; \
            echo 'post_max_size=128M'; \
        } > /usr/local/etc/php/conf.d/opcache-recommended.ini

COPY . /var/www/html

RUN chmod 777 -R /var/www/html/vendor && \
    chmod 777 -R /var/www/html/storage

