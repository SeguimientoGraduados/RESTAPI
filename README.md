# Graduados UNS API REST usando Laravel 10 
Se utiliza Sanctum para la autenticacion en la aplicacion

## Para correr el proyecto
Como requerimientos previos se necesitan: 
 - PHP version 8.1 o superior
 - composer

### Pasos
1. Descargar el proyecto (o clonarlo con GIT)
2. Copiar `.env.example` en `.env` y configurar las credenciales de tu base de datos
3. Ir a la raiz del proyecto en una terminal y correr el comando: `composer install`
4. Setear la application key corriendo el comando: `php artisan key:generate --ansi`
5. Correr las migraciones con el comando: `php artisan migrate`
6. Iniciar el servidor local con el comando: `php artisan serve`

#### Autores: Dylan Hughes y Gonzalo Riquelme Ludwig