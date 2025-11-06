<?php

// use Dotenv\Dotenv;
// use Model\ActiveRecord;
// require __DIR__ . '/../vendor/autoload.php';

// $dotenv = Dotenv::createImmutable(__DIR__);
// $dotenv->safeLoad();

// require 'funciones.php';
// require 'database.php';


// //Conectar a la base de datos
// $db = conectarDB();

// ActiveRecord::setDB($db);



use Dotenv\Dotenv;
use Model\ActiveRecord;

require __DIR__ . '/../vendor/autoload.php';

// Define la raíz del proyecto (1 nivel arriba de /includes)
if (!defined('ROOT_DIR')) {
    define('ROOT_DIR', dirname(__DIR__));
}

// Carga .env desde la raíz del proyecto
$dotenv = Dotenv::createImmutable(ROOT_DIR);
$dotenv->safeLoad();

require __DIR__ . '/funciones.php';
require __DIR__ . '/database.php';

// Conectar a la base de datos
$db = conectarDB();
ActiveRecord::setDB($db);


?>

