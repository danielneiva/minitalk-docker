FROM composer:2 as vendor

WORKDIR /app

COPY composer.json composer.json

COPY . .

RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist

RUN composer dump-autoload --optimize

FROM php:8.2-fpm-alpine

WORKDIR /app

RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN apk update && apk add \
    supervisor \
    zip \
    unzip \
    curl \
    nginx

RUN apk add --no-cache pcre-dev $PHPIZE_DEPS && pecl install redis && docker-php-ext-enable redis.so

COPY ./supervisor.conf /etc/supervisord.conf
COPY ./nginx.conf /etc/nginx/http.d/default.conf
COPY . .
COPY --from=vendor /app/vendor/ ./vendor/

RUN php artisan event:clear && php artisan route:clear && php artisan config:clear && php artisan view:clear

EXPOSE 8080

CMD ["/bin/sh", "-c", "php artisan route:list"]

#ENTRYPOINT ["/bin/sh", "-c" , "php artisan optimize && php artisan migrate --force --seed && php artisan storage:link && /usr/bin/supervisord -c /etc/supervisord.conf"]

