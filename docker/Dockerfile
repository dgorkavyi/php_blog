FROM php:8.0.2-fpm

RUN apt-get update && apt-get install -y \
	git \
	curl \
	zip \
	unzip

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

RUN install-php-extensions gd mysqli pdo xdebug pdo_mysql



WORKDIR /var/www
