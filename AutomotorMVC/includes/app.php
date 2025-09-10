<?php

use Dotenv\Dotenv;
use Model\ActiveRecord;
require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

require 'funciones.php';
require_once __DIR__ . '/config/database.php';


//Conectar a la base de datos
$db = conectarDB();

ActiveRecord::initDB();



?>