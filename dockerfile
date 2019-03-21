FROM debian:stretch

RUN apt update
RUN apt upgrade

RUN apt install -y apt-transport-https wget lsb-release curl composer

RUN wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg
RUN sh -c 'echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list'
RUN apt update

RUN apt install -y php7.2 php7.2-mbstring php7.2-curl php7.2-dom
RUN apt install -y apache2 libapache2-mod-php7.2

RUN a2enmod rewrite
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf
RUN sed -i 's/\/var\/www\/html/\/var\/www\/html\/github-api\/public/' /etc/apache2/sites-available/000-default.conf

ADD . /var/www/html/github-api
RUN chown -R www-data:www-data /var/www/html/github-api/storage
RUN chown -R www-data:www-data /var/www/html/github-api/bootstrap/cache

RUN composer install -d /var/www/html/github-api

EXPOSE 80
CMD apachectl -D FOREGROUND