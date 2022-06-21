# Tienda Online
Ejercicio en Laravel para PoderJudicialVirtual.com

Para su ejecución se deben seguir los siguientes pasos:

- Descargar el repositorio en el siguiente enlace:

    [Descargar Repositorio](https://github.com/jorgerenteral/tienda-online/archive/refs/heads/main.zip)

- O clonarlo con el comando:

    `git clone https://github.com/jorgerenteral/tienda-online.git`

## Prerrequisitos

Debes crear una base de datos con el nombre **tienda_online**

## Instrucciones
1) Debes tener instalado Composer y ejecutar el siguiente comando en la carpeta del proyecto. Nota: Si has descargado el repositorio comprimido, debes descomprimirlo en una carpeta, ingresar a ella para ejecutar el siguiente comando:

    `composer install`

2) Una vez instaladas las dependencias, debes ejecutar el siguiente comando para generar el archivo de variables de entorno:

    `php -r \"file_exists('.env') || copy('.env.example', '.env')`

3) Ahora se genera la clave de la aplicación con el siguiente comando:

    `php artisan key:generate --ansi`

4) Al ejecutar el siguiente comando, se corren las migraciones y los 'seeders':

    `php artisan migrate --seed`

5) Solo falta crear el servidor con este comando:

    `php artisan serve`

¡Listo! Ya puedes ingresar con el correo **admin@example.com** y la contraseña **admin**.

Para registrar un nuevo cliente, ve directo a `http://localhost:8000/register`