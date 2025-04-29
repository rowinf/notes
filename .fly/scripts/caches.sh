#!/usr/bin/env bash

/usr/bin/php /var/www/html/artisan config:clear --no-ansi -q
/usr/bin/php /var/www/html/artisan route:cache --no-ansi -q
/usr/bin/php /var/www/html/artisan view:cache --no-ansi -q
