# Graduados UNS 
![image](https://github.com/user-attachments/assets/13e0bd32-1141-4416-8eb3-9784ec331139)

## Para correr el proyecto
### Requerimientos previos:
- PHP versión 8.1 o superior
- Composer

### Pasos:
1. Descargar el proyecto (o clonarlo con GIT).
2. Copiar `.env.example` a `.env` y configurar las credenciales de tu base de datos.
3. Ir a la raíz del proyecto en una terminal y correr el comando: `composer install`.
4. Establecer la application key corriendo el comando: `php artisan key:generate --ansi`.
5. Correr las migraciones con el comando: `php artisan migrate --seed`.
6. Iniciar el servidor local con el comando: `php artisan serve`.

## Descripción del API REST usando Laravel 10 
Esta API fue desarrollada como backend para la aplicación [Graduados UNS](https://graduados.vercel.app/). Puedes encontrar el repositorio del frontend en la siguiente URL: [https://github.com/SeguimientoGraduados/SPA](https://github.com/SeguimientoGraduados/SPA).

La API abarca toda la lógica del negocio vinculada a esta aplicación y todo lo asociado a la autenticación de usuarios, que se realizó utilizando la libreria de Sanctum. Se manejan diferentes roles para los endpoints, y la mayoría requiere que un usuario esté logueado, mientras que algunos exclusivamente requieren que el usuario sea administrador.

### Listado de Endpoints:

**Usuario sin loguear:**
- `POST /register` - Registrar un nuevo usuario.
- `POST /login` - Iniciar sesión.
- `GET /graduados` - Obtener graduados con filtros.
- `GET /valores-filtro` - Obtener valores para filtrar.
- `GET /carreras` - Obtener todas las carreras.

**Usuario logueado:**
- `POST /logout` - Cerrar sesión.
- `POST /graduados` - Registrar un nuevo graduado.
- `PUT /graduados/{id}` - Actualizar datos del graduado.
- `GET /usuario` - Obtener datos personales.
- `GET /enumerados` - Obtener enumerados.

**Admin logueado:**
- `GET /graduados/validar` - Obtener graduados por validar.
- `PUT /graduados/{id}` - Actualizar datos del graduado.
- `POST /graduados/{id}/rechazar` - Rechazar graduado.
- `GET /graduados/exportar` - Obtener graduados por filtro para exportar a Excel.
- `GET /graduados/filtrar` - Obtener graduados por filtro (con más información).

## Pruebas
Para el testeo se utilizó Postman. Se adjunta el enlace a la colección utilizada: [https://graduados-uns.postman.co/workspace/9da79e4a-440e-40c9-af2e-ae2246a0c2d8](https://graduados-uns.postman.co/workspace/9da79e4a-440e-40c9-af2e-ae2246a0c2d8)

#### Autores: 
- Dylan Hughes 
- Gonzalo Riquelme Ludwig
