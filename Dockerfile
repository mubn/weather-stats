FROM php:7.4.14-apache
LABEL maintainer="docker@marekurban.de"
ARG ARG_APACHE_LISTEN_PORT=8080
ENV APACHE_LISTEN_PORT=${ARG_APACHE_LISTEN_PORT}
RUN sed -s -i -e "s/80/${APACHE_LISTEN_PORT}/" /etc/apache2/ports.conf /etc/apache2/sites-available/*.conf

COPY app /var/www/html
RUN chown -R www-data:www-data /var/www/html
RUN mkdir /db
RUN chown www-data:www-data /db
USER www-data
EXPOSE ${APACHE_LISTEN_PORT}
