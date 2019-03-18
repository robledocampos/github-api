FROM debian:stretch

RUN apt update
RUN apt upgrade

RUN apt install -y apt-transport-https wget lsb-release curl

RUN wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg
RUN sh -c 'echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list'
RUN apt update

RUN apt-get install -y php7.2 php7.2-mbstring php7.2-curl
RUN apt install -y apache2 libapache2-mod-php7.2

RUN sed -i 's/\/var\/www\/html/\/var\/www\/html\/api\/public/' /etc/apache2/sites-available/000-default.conf

ADD . /var/www/html/api
RUN chown -R www-data:www-data /var/www/html/api/storage

EXPOSE 80
CMD apachectl -D FOREGROUND