FROM nginx:latest AS nginx-base
COPY localhost.key /keys/tls.key
COPY localhost.crt /keys/tls.crt
COPY files/ /app/

FROM nginx-base AS nginx-nodelay
COPY nginx-nodelay.conf /etc/nginx/conf.d/default.conf

FROM nginx-base AS nginx-delay
COPY nginx.conf /etc/nginx/conf.d/default.conf

FROM php:8.1-fpm AS php-delay
COPY files/ /app/
