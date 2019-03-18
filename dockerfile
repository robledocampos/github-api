FROM debian:stretch

RUN apt-get update
RUN apt-get upgrade

RUN apt-get install -y php
RUN apt-get install -y apache2 libapache2-mod-php

ADD . /var/www/html/api

EXPOSE 80
CMD apachectl -D FOREGROUND