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

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

require 'funciones.php';
require_once __DIR__ . '/database.php';


//Conectar a la base de datos
$db = conectarDB();

ActiveRecord::initDB();
?>