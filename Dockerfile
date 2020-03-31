FROM php:7.4-apache

LABEL maintainer="docker@marekurban.de"

COPY app/ /var/www/html

RUN mkdir /db && chown www-data:www-data /db
