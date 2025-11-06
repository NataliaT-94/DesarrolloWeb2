<?php 

// require 'funciones.php';
// require 'database.php';
// require __DIR__ . '/../vendor/autoload.php';

// // Conectarnos a la base de datos
// use Model\ActiveRecord;
// ActiveRecord::setDB($db);

use Dotenv\Dotenv;
use Model\ActiveRecord;
require __DIR__ . '/../vendor/autoload.php';

// Iniciar sesión (solo si no está iniciada)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// Define la raíz del proyecto (1 nivel arriba de /includes)
if (!defined('ROOT_DIR')) {
    define('ROOT_DIR', dirname(__DIR__));
}

// Carga .env desde la raíz del proyecto
$dotenv = Dotenv::createImmutable(ROOT_DIR);
$dotenv->safeLoad();



require __DIR__ . '/funciones.php';
require __DIR__ . '/database.php';


//Conectar a la base de datos
$db = conectarDB();

ActiveRecord::initDB($db);

// Definir una constante global con la URL base del proyecto
if (!defined('BASE_URL')) {
    define('BASE_URL', $_ENV['APP_URL'] ?? '/');
}
?>