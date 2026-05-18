#!/bin/sh
set -e

echo "--- Creando .env desde variables de entorno ---"

# Railway inyecta MYSQLHOST, MYSQLPORT, etc. — usamos DB_* si existen, si no los de Railway
_DB_HOST="${DB_HOST:-${MYSQLHOST:-}}"
_DB_PORT="${DB_PORT:-${MYSQLPORT:-3306}}"
_DB_DATABASE="${DB_DATABASE:-${MYSQLDATABASE:-railway}}"
_DB_USERNAME="${DB_USERNAME:-${MYSQLUSER:-root}}"
_DB_PASSWORD="${DB_PASSWORD:-${MYSQLPASSWORD:-}}"

echo "--- DB_HOST resuelto: $_DB_HOST ---"

cat > /app/.env << ENVEOF
APP_NAME=TravelAI
APP_ENV=${APP_ENV:-production}
APP_KEY=${APP_KEY:-}
APP_DEBUG=${APP_DEBUG:-false}
APP_URL=${APP_URL:-http://localhost:8080}

DB_CONNECTION=mysql
DB_HOST=${_DB_HOST}
DB_PORT=${_DB_PORT}
DB_DATABASE=${_DB_DATABASE}
DB_USERNAME=${_DB_USERNAME}
DB_PASSWORD=${_DB_PASSWORD}

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
FILESYSTEM_DISK=local
BROADCAST_CONNECTION=log
LOG_CHANNEL=stack
LOG_LEVEL=error

CORS_ALLOWED_ORIGINS=${CORS_ALLOWED_ORIGINS:-}

GOOGLE_CLIENT_ID=${GOOGLE_CLIENT_ID:-}
STRIPE_SECRET=${STRIPE_SECRET:-}
RESEND_API_KEY=${RESEND_API_KEY:-}
GROQ_API_KEY=${GROQ_API_KEY:-}

MAIL_MAILER=log
ENVEOF

echo "--- Generando APP_KEY si no existe ---"
if [ -z "${APP_KEY}" ]; then
  php artisan key:generate --force
fi

echo "--- Esperando a la base de datos ---"
until php -r "
\$h = '$_DB_HOST';
\$p = '$_DB_PORT';
\$u = '$_DB_USERNAME';
\$pw = '$_DB_PASSWORD';
new PDO(\"mysql:host=\$h;port=\$p\", \$u, \$pw);
" 2>/dev/null; do
  echo "BD no disponible, reintentando..."
  sleep 3
done

echo "--- BD lista, ejecutando migraciones ---"
php artisan migrate:fresh --force

echo "--- Ejecutando seeders ---"
php artisan db:seed --force

echo "--- Enlace de almacenamiento ---"
php artisan storage:link --force

echo "--- Cacheando configuracion ---"
php artisan config:cache

echo "--- Arrancando servidor en puerto ${PORT:-8080} ---"
exec php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
