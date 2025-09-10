# composer
-Terminal
composer init
Package name (<vendor>/<name>) [natt1/nails-app-mvc]: enter
Description []: Proyecto PHP 8, MVC, SQL, SASS, Gulp
Author [NataliaT-94 <nattecheira@gmail.com>, n to skip]: enter 
Minimum Stability []: 
Package Type (e.g. library, project, metapackage, composer-plugin) []: project
License []: enter

Define your dependencies.

Would you like to define your dependencies (require) interactively [yes]? no
Would you like to define your dev dependencies (require-dev) interactively [yes]? no
Add PSR-4 autoload mapping? Maps namespace "Natt1\NailsAppMvc" to the entered relative path. [src/, n to skip]:

{
    "name": "natt1/nails-app-mvc",
    "description": "Proyecto PHP 8, MVC, SQL, SASS, Gulp",
    "type": "project",
    "autoload": {
        "psr-4": {
            "Natt1\\NailsAppMvc\\": "src/"
        }
    },
    "authors": [
        {
            "name": "NataliaT-94",
            "email": "nattecheira@gmail.com"
        }
    ],
    "require": {}
}

Do you confirm generation [yes]? yes
------------------------------------

#composer.json
    "autoload": {
        "psr-4": {
            "MVC\\": "./",
            "Controllers\\": "./controllers",
            "Model\\": "./model"
        }
    }
    ------------------------------------
-Terminal
composer update : para actualizar el composer.json

cd public : para ir a la carpeta public

 php -S localhost:3000 : creamos un localhost desde la carpeta public
 
# composer require phpmailer/phpmailer
composer update

------------------------------------------
# https://mailtrap

phpMailer

-------------------------------------------
# Deployment y variables de entorno
composer require vlucas/phpdotenv: en terminal

-------------------------------------------
# Correr project
En la carpeta public click derecho terminal 
comando php -S localhost:3000