FROM php:7.2-fpm-alpine AS base

RUN apk add --no-cache bash git curl

FROM base AS deps
RUN apk add --no-cache $PHPIZE_DEPS coreutils php7-pcntl
RUN pecl install xdebug-2.6.1 ast-1.0.0

# Install Composer
RUN echo "$(curl -sS https://composer.github.io/installer.sig) -" > composer-setup.php.sig \
    && curl -sS https://getcomposer.org/installer | tee composer-setup.php | sha384sum -c composer-setup.php.sig \
    && php composer-setup.php --install-dir=/usr/bin --filename=composer \
    && rm composer-setup.php; rm composer-setup.php.sig;

FROM base AS release
COPY --from=deps /usr/bin/composer /usr/bin/composer
COPY --from=deps /usr/local/lib/php/extensions/no-debug-non-zts-20170718/ast.so /usr/local/lib/php/extensions/no-debug-non-zts-20170718/ast.so
COPY --from=deps /usr/local/lib/php/extensions/no-debug-non-zts-20170718/xdebug.so /usr/local/lib/php/extensions/no-debug-non-zts-20170718/xdebug.so
COPY ./phpdbg-wrapper /usr/local/bin/phpdbg-noxdebug
RUN docker-php-ext-enable xdebug ast

EXPOSE 9000

CMD ["php-fpm", "-R", "--nodaemonize"]

