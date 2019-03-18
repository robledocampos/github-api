FROM debian:stretch

RUN apt-get update
RUN apt-get upgrade

RUN apt-get install -y php
RUN apt-get install -y apache2 libapache2-mod-php


RUN sed '\/var\/www\/html\/\/var\/www\/html\/api\/public' /etc/apache2/sites-available/000-default.conf

ADD . /var/www/html/api
RUN chown -R www-data:www-data /var/www/html/api/storage

EXPOSE 80
CMD apachectl -D FOREGROUND