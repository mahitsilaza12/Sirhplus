#!/bin/bash
set -e

# first arg is `-f` or `--some-option`
if [ "${1#-}" != "$1" ]; then
	set -- php-fpm "$@"
fi

if [ "$1" = 'php-fpm' ] || [ "$1" = 'bin/console' ]; then
    #composer dump-autoload --optimize --no-dev --classmap-authoritative
    composer install

    #drop all schema && migrate
    php bin/console doctrine:schema:update --force
    composer run post-install-cmd

	# Permissions hack because setfacl does not work on Mac and Windows
	chown -R www-data var
fi

exec docker-php-entrypoint "$@"
