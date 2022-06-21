# FROM ubuntu:20.04
FROM lifebytehub/ubuntu-lemp:0.0.1

WORKDIR /var/www/

# Copy project into image.
COPY src/ /var/www/

COPY nginx-default.conf /etc/nginx/sites-enabled/default
COPY nginx-main.conf /etc/nginx/nginx.conf

# Migrate laravel error log.
RUN mkdir /var/log/laravel && touch /var/log/laravel/laravel.log && touch /var/log/laravel/applications.log
RUN ln -s /var/log/laravel/laravel.log /var/www/storage/logs/laravel.log
RUN ln -s /var/log/laravel/applications.log /var/www/storage/logs/applications.log

#RUN chmod -R 777 storage/logs/laravel.log
# ownership =>  www-data:adm for logging
RUN chown -R 33:4 /var/log/laravel/
RUN chown -R 33:33 storage/logs/laravel.log

# the bash script isn't executed but can be useful for debugging
COPY entrypoint.sh /
RUN chmod +x /entrypoint.sh

# Install independencies and paackages
RUN composer install
RUN npm install --production

# Set app permission
RUN chown -R www-data:www-data /var/www
RUN chmod -R 775 storage bootstrap/cache

# Clean up
RUN rm -f package.json package-lock.json

## Start Nginx
EXPOSE 80
ENTRYPOINT  service php8.0-fpm restart \
    && service nginx restart \
    && php artisan migrate --force \
    && php artisan cache:clear \
    && /usr/bin/php artisan optimize:clear \
    && /usr/bin/php artisan config:cache \
    && tail -f /var/log/nginx/* /var/log/laravel/laravel.log
