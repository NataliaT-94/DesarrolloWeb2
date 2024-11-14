<?php

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\AutomotorController;

$router = new Router();

$router -> get('admin', [AutomotorController::class, 'index']);
// $router -> get('./vehiculos/crear', [AutomotorController::class, 'crear']);
// $router -> get('./vehiculos/actualizar', [AutomotorController::class, 'actualizar']);


$router -> comprobarRutas();


?>