FROM php:7.1-apache
MAINTAINER Gyula Szabó <gyufi@szabocsalad.com>

# Utilities
RUN apt-get update && \
    apt-get -y install apt-transport-https git --no-install-recommends && \
    rm -r /var/lib/apt/lists/*

# SimpleSAMLphp
ARG SIMPLESAMLPHP_VERSION=1.17.2
ADD https://github.com/simplesamlphp/simplesamlphp/releases/download/v$SIMPLESAMLPHP_VERSION/simplesamlphp-$SIMPLESAMLPHP_VERSION.tar.gz /tmp/simplesamlphp.tar.gz

RUN tar xzf /tmp/simplesamlphp.tar.gz -C /tmp && \
    rm -f /tmp/simplesamlphp.tar.gz  && \
    mv /tmp/simplesamlphp-* /var/www/simplesamlphp && \
    touch /var/www/simplesamlphp/modules/exampleauth/enable
COPY config/simplesamlphp/config.php /var/www/simplesamlphp/config
COPY config/simplesamlphp/authsources.php /var/www/simplesamlphp/config
COPY config/simplesamlphp/server.crt /var/www/simplesamlphp/cert/
COPY config/simplesamlphp/server.pem /var/www/simplesamlphp/cert/
COPY config/simplesamlphp/saml20-idp-hosted.php /var/www/simplesamlphp/metadata/saml20-idp-hosted.php

# Apache
COPY config/apache/ports.conf /etc/apache2
COPY config/apache/simplesamlphp.conf /etc/apache2/sites-available
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf && \
    a2dissite 000-default.conf default-ssl.conf && \
    a2ensite simplesamlphp.conf

# Set work dir
WORKDIR /var/www/simplesamlphp
