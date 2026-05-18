#!/bin/sh
set -e

echo "--- Esperando a MySQL ---"
until php -r "new PDO('mysql:host=db;port=3306', 'travelai', 'Travelai1234?');" > /dev/null 2>&1; do
  sleep 2
done

echo "--- MySQL detectado! ---"

echo "--- Ejecutando Migraciones ---"
php artisan migrate:fresh --force

echo "--- Creando enlace de almacenamiento ---"
php artisan storage:link --force

echo "--- Ejecutando Seeders ---"
php artisan db:seed --force

# Permisos
chmod -R 775 /var/www/storage /var/www/bootstrap/cache
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

echo "--- Arrancando PHP-FPM ---"
exec php-fpm