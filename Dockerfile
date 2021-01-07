FROM php:7.4.14-apache

LABEL maintainer="docker@marekurban.de"

COPY app/ /var/www/html

RUN mkdir /db

RUN chown www-data:www-data /db
