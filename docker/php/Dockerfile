FROM php:7.4-fpm-alpine

RUN apk add --update libzip-dev curl-dev &&\
    docker-php-ext-install curl && \
    apk del gcc g++ &&\
    rm -rf /var/cache/apk/*
    
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install sockets curl

RUN apk add --no-cache zip libzip-dev
RUN docker-php-ext-configure zip
RUN docker-php-ext-install zip

RUN apk update && apk add --no-cache bash \
        alsa-lib \
        at-spi2-atk \
        atk \
        cairo \
        cups-libs \
        dbus-libs \
        eudev-libs \
        expat \
        flac \
        gdk-pixbuf \
        glib \
        libgcc \
        libjpeg-turbo \
        libpng \
        libwebp \
        libx11 \
        libxcomposite \
        libxdamage \
        libxext \
        libxfixes \
        tzdata \
        libexif \
        udev \
        xvfb \
        zlib-dev \
        chromium \
        chromium-chromedriver
RUN ln -fs /usr/lib/chromium/chromedriver /usr/local/bin/chromedriver

ENV PANTHER_NO_SANDBOX 1
ENV PANTHER_CHROME_ARGUMENTS='--disable-dev-shm-usage --disable-gpu --disable-extensions --remote-debugging-port=9222'
ENV PANTHER_CHROME_DRIVER_BINARY /usr/bin/chromedriver

RUN set -xe \
    && apk add --update \
        icu \
    && apk add --no-cache --virtual .php-deps \
        make \
    && apk add --no-cache --virtual .build-deps \
        $PHPIZE_DEPS \
        zlib-dev \
        icu-dev \
        g++ \
    && docker-php-ext-configure intl \
    && docker-php-ext-install \
        intl \
    && docker-php-ext-enable intl \
    && { find /usr/local/lib -type f -print0 | xargs -0r strip --strip-all -p 2>/dev/null || true; } \
    && apk del .build-deps \
    && rm -rf /tmp/* /usr/local/lib/php/doc/* /var/cache/apk/*

RUN apk --update --no-cache add build-base \
        autoconf \
        rabbitmq-c-dev
    
RUN pecl install amqp
RUN docker-php-ext-enable amqp

RUN curl -sSk https://getcomposer.org/installer | php -- --disable-tls && \
   mv composer.phar /usr/local/bin/composer

WORKDIR /home/wwwroot/sf5

RUN echo "* * * * * php /home/wwwroot/sf5 bin/console cron:run schedule:run >> /var/log/cron.log 2>&1" >> /etc/crontab

# Create the log file to be able to run tail
RUN touch /var/log/cron.log

RUN apk add --no-cache yarn --repository="http://dl-cdn.alpinelinux.org/alpine/edge/community" 
RUN yarn -v
RUN yarn add bootstrap --dev
EXPOSE 9000
CMD ["php-fpm"]