# TravelAI - Sistema de Gestión de Viajes con IA

Este es el proyecto de TFG para la gestión de vuelos y hoteles. La aplicación utiliza **Laravel 11** para el Backend, **React** para el Frontend y **MySQL** como base de datos, todo levantado con **Docker**.

## Requisitos Previos

Antes de empezar, tener instalado:

- Docker

## Configuración Inicial (Solo la primera vez)

### 1. Variables de Entorno

Crea el archivo de configuración del Backend:

- Copia el archivo "backend/.env.example" y renombrarlo como "backend/.env".
- Pegar los datos de la DB, tienen que coincidir con los del "docker-compose.yml":
  - DB_CONNECTION=mysql
  - DB_HOST=db
  - DB_PORT=3306
  - DB_DATABASE=travelai
  - DB_USERNAME=travelai
  - DB_PASSWORD="Travelai1234?"

- Tambien puedes copiar el contenido de .env.setup y pegarlo en .env (.env.setup es una copia del .env ya funcionando).

- Usuario y contraseña para entrar en phpMyAdmin (puerto 8083):
  - Usuario: travelai
  - Contraseña: Travelai1234?

### 2. Levantar los Contenedores

- Desde la raíz del proyecto (TravelAI):
- chmod +x docker/entrypoint.sh
- docker compose up -d --build

### 3. Instalar dependencias para laravel (SOLO SI NO SE QUIERE USAR EL ENTRYPOINT.SH)

- docker exec -it travelai-app composer install
- docker exec -it travelai-app php artisan key:generate
- docker exec -it travelai-app php artisan migrate --seed

## 4. (OPCIONAL) Lanzar el seeder para meter los datos de prueba

- docker exec -it travelai-app php artisan db:seed --class=DatabaseSeeder

## Direcciones de acceso:

- Frontend (React): http://localhost:8081
- Backend API (Laravel): http://localhost:8082
- phpMyAdmin: http://localhost:8083

## Comandos utiles:

- Ver Logs del Frontend (para errores): docker logs -f travelai-frontend
- Limpiar caché de Laravel: docker exec -it travelai-app php artisan config:clear
- Refrescar Base de Datos y añadir datos: docker exec -it travelai-app php artisan migrate:fresh --seed
- Acceder al contenedor de Laravel: docker exec -it travelai-app bash

## Usuarios introducidos por los seeders y sus credenciales:

- Admin:
  Nombre: Administrador
  Email: admin@admin.es
  Contraseña: Admin1234?

- Moderador:
  Nombre: Moderador
  Email: mod@mod.es
  Contraseña: Mod1234?

- Usuario Premium:
  Nombre: Premium
  Email: premium@premium.es
  Contraseña: Premium1234?

- Usuario:
  Nombre: Usuario
  Email: user@user.es
  Contraseña: Usuario1234?

- Tester:
  Nombre: Tester
  Email: tester@tester.es
  Contraseña: Tester1234?
