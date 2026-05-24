# TravelAI - Guía de instalación local

TravelAI es un sistema de gestión de viajes con inteligencia artificial construido con **Laravel 11** (Backend), **React 19** (Frontend) y **MySQL**, todo orquestado con **Docker**.

---

## Requisitos previos

- **Docker Desktop** instalado y en ejecución
- Puerto **8081**, **8082**, **8083** y **3306** libres

---

## Pasos de instalación

### 1. Clonar el repositorio

```bash
git clone https://github.com/druiman1608/TravelAI.git
cd TravelAI
```

### 2. Configurar las variables de entorno del Backend

Copia el archivo `.env.setup` como `.env` dentro de la carpeta `backend`:

El archivo `frontend/.env` ya está incluido en el repositorio con la clave pública de Stripe y el cliente de Google OAuth.

### 3. Dar permisos al entrypoint (solo Linux)

```bash
chmod +x docker/entrypoint.sh
```

### 4. Levantar los contenedores

Desde la raíz del proyecto:

```bash
docker compose up -d --build
```

La primera vez tarda entre **3 y 5 minutos** mientras se construyen las imágenes y se descargan las dependencias.

### 5. Esperar a que el Backend esté listo

Al arrancar por primera vez el contenedor `travelai-app` ejecuta automáticamente:

- Migraciones de base de datos
- Creación del enlace de almacenamiento de imágenes (`storage:link`)
- Carga de datos de prueba (seeders)

Puedes seguir el proceso en tiempo real con:

```bash
docker logs -f travelai-app
```

Cuando veas `--- Arrancando PHP-FPM ---` en los logs, la aplicación está lista.

---

## Direcciones de acceso

| Servicio              | URL                       |
| --------------------- | ------------------------- |
| Frontend (React)      | http://localhost:8081     |
| Backend API (Laravel) | http://localhost:8082/api |
| phpMyAdmin            | http://localhost:8083     |

**Credenciales de phpMyAdmin:**

- Usuario: `travelai`
- Contraseña: `Travelai1234?`

---

## Usuarios de prueba

Estos usuarios se crean automáticamente con los seeders:

| Rol              | Nombre           | Email                  | Contraseña     |
| ---------------- | ---------------- | ---------------------- | -------------- |
| Administrador    | Carlos Rodríguez | admin@travelai.com     | Admin1234!     |
| Moderador        | Ana Martínez     | moderador@travelai.com | Moderador1234! |
| Usuario Premium  | Luis García      | premium@travelai.com   | Premium1234!   |
| Usuario estándar | María López      | usuario@travelai.com   | Usuario1234!   |

> **Nota sobre pagos:** Stripe está en modo test. Para simular un pago utiliza el número de tarjeta `4242 4242 4242 4242`, cualquier fecha de caducidad futura y cualquier CVC.

---

## Funcionalidades principales

| Funcionalidad                                                  | Disponible en local                                  |
| -------------------------------------------------------------- | ---------------------------------------------------- |
| Registro e inicio de sesión                                    | ✅                                                   |
| Login con Google                                               | ✅ (requiere conexión a internet)                    |
| Búsqueda y filtrado de vuelos, hoteles, actividades y paquetes | ✅                                                   |
| Detalle de oferta con reseñas                                  | ✅                                                   |
| Checkout y pago con Stripe (modo test)                         | ✅                                                   |
| Chat de IA (Groq)                                              | ✅ (requiere conexión a internet)                    |
| Panel de administración                                        | ✅ (acceder con usuario Admin)                       |
| Moderación de reseñas                                          | ✅ (acceder con usuario Moderador)                   |
| Emails de confirmación                                         | ✅ (se envían a la cuenta del propietario de Resend) |

---

## Comandos útiles

```bash
# Ver logs del backend en tiempo real
docker logs -f travelai-app

# Ver logs del frontend
docker logs -f travelai-frontend

# Resetear la base de datos y volver a cargar los seeders
docker exec -it travelai-app php artisan migrate:fresh --seed

# Limpiar caché de configuración de Laravel
docker exec -it travelai-app php artisan config:clear

# Acceder al contenedor del backend
docker exec -it travelai-app bash

# Parar todos los contenedores
docker compose down

# Parar y eliminar volúmenes (borra la base de datos)
docker compose down -v
```

---

## Solución de problemas comunes

**El frontend carga pero la API devuelve error de conexión**

- Espera a que el backend termine de ejecutar las migraciones (ver paso 5).
- Comprueba que `backend/.env` existe y tiene `APP_KEY` configurado.

**Las imágenes no se muestran**

- El entrypoint ejecuta `storage:link` automáticamente. Si aun así no aparecen, ejecuta manualmente:

```bash
docker exec -it travelai-app php artisan storage:link --force
```

**Error al levantar los contenedores por puerto ocupado**

- Comprueba que los puertos 8081, 8082, 8083 y 3306 no están en uso por otra aplicación.

**La base de datos aparece vacía**

- Los seeders pueden tardar unos segundos después de las migraciones. Espera y recarga la página, o ejecuta:

```bash
docker exec -it travelai-app php artisan db:seed --force
```
