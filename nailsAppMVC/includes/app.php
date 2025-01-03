<?php

require 'funciones.php';
require 'database.php';
require '/../vendor/autoload.php';

//Conectar a la bd

use Model\ActiveRecord;
ActiveRecord::setDB($db);

?>