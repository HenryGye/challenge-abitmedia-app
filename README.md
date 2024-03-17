# Prueba técnica challenge-abitmedia-app
* Realizado en laravel 11.0, PHP 8.2 y MySQL

## Objetivo

Gestionar oferta de productos mediante la implementación de una API REST en PHP con persistencia de datos con operaciones CRUD.

## Requisitos

* Tener instalado Xampp (en caso de S.O. Windows) para usar BD MySql
* Tener instalado Composer (Descargar https://getcomposer.org/Composer-Setup.exe)
* Tener instalado Laravel en la versión >= 11.x (Una vez instalado Composer se puede ejecutar el comando `composer global require laravel/installer`)

## Instalación
* Clonar el proyecto del repositorio https://github.com/HenryGye/challenge-abitmedia-app.git

* Crear la base de datos `challenge_abitmedia_app`

* Instalar dependencias del proyecto
  - `composer install`
  - `npm install`

* Crear archivo .env y configurar la BD (configuración por defecto generado al crear el proyecto Laravel)

    ```DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=challenge_abitmedia_app
    DB_USERNAME=root
    DB_PASSWORD=```

* Generar key
  - `php artisan key:generate`

* Ejecutar migraciones
  - `php artisan migrate`

* Ejecutar seeder
  - `php artisan db:seed`

* Ejecutar proyecto
  - `php artisan serve`