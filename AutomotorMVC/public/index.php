<?php

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\AutomotorController;
use Controllers\LoginController;
use Controllers\VendedorController;
use Controllers\PaginasController;

$router = new Router();

//Zona Privada
$router->get('/', [AutomotorController::class, 'index']);
$router->get('/vehiculos/crear', [AutomotorController::class, 'crear']);
$router->post('/vehiculos/crear', [AutomotorController::class, 'crear']);
$router->get('/vehiculos/actualizar', [AutomotorController::class, 'actualizar']);
$router->post('/vehiculos/actualizar', [AutomotorController::class, 'actualizar']);
$router->post('/vehiculos/eliminar', [AutomotorController::class, 'eliminar']);

$router->get('/', [AutomotorController::class, 'index']);
$router->get('/vendedores/crear', [VendedorController::class, 'crear']);
$router->post('/vendedores/crear', [VendedorController::class, 'crear']);
$router->get('/vendedores/actualizar', [VendedorController::class, 'actualizar']);
$router->post('/vendedores/actualizar', [VendedorController::class, 'actualizar']);
$router->post('/vendedores/eliminar', [VendedorController::class, 'eliminar']);

//Zona Publica
$router->get('/', [PaginasController::class, 'index']);
$router->get('/nosotros', [PaginasController::class, 'nosotros']);
$router->get('/vehiculos', [PaginasController::class, 'vehiculos']);
$router->get('/vehiculo', [PaginasController::class, 'vehiculo']);
$router->get('/blog', [PaginasController::class, 'blog']);
$router->get('/entrada', [PaginasController::class, 'entrada']);
$router->get('/contacto', [PaginasController::class, 'contacto']);
$router->post('/contacto', [PaginasController::class, 'contacto']);

//Login y Autenticacion
$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router -> comprobarRutas();


?>