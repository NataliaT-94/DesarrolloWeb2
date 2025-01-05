<?php

require_once __DIR__ . '/../includes/app.php';

use Controllers\LoginController;
use MVC\Router;

$router = new Router();

//Iniciar Sesion
$router->get('/', [LoginController::class, 'login']);//login sale de la funcion login que esta en el archivo LoginController
$router->post('/', [LoginController::class, 'login']);//post: es cuando lleno el formulario y lo envio
$router->get('/logout', [LoginController::class, 'logouts']);//logout cuando cerramos sesion

//Recuperar Password
$router->get('/olvide', [LoginController::class, 'olvide']);
$router->post('/olvide', [LoginController::class, 'olvide']);
$router->get('/recuperar', [LoginController::class, 'recuperar']);
$router->post('/recuperar', [LoginController::class, 'recuperar']);

//Crear Cuenta
$router->get('/crear-cuenta', [LoginController::class, 'crear']);
$router->post('/crear-cuenta', [LoginController::class, 'crear']);


//Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();


?>