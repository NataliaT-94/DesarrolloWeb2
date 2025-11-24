<?php

namespace MVC;

class Router {

    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn) {//tomas las url que  reaccionan con get, primer parametro la url y el segundo parametro la funcion que cumple
        $this->rutasGET[$url] = $fn;
    }

    public function post($url, $fn) {//tomas las url que  reaccionan con post, primer parametro la url y el segundo parametro la funcion que cumple
        $this->rutasPOST[$url] = $fn;
    }

    public function comprobarRutas() {//valida que las rutas existan

        // URI sin querystring
        $uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';

        // Directorio donde está el script (index.php)
        $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/'));
        $scriptDir = rtrim($scriptDir, '/');

        // Normalizar la URI quitando el subdirectorio del proyecto
        if ($scriptDir && $scriptDir !== '/' && strpos($uri, $scriptDir) === 0) {
            $uri = substr($uri, strlen($scriptDir)) ?: '/';
        }

        // Iniciar sesión solo si no está iniciada
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $auth = $_SESSION['login'] ?? null;

        // Rutas protegidas
        $rutas_protegidas = [
            '/admin',
            '/vehiculos/crear',
            '/vehiculos/actualizar',
            '/vehiculos/eliminar',
            '/vendedores/crear',
            '/vendedores/actualizar',
            '/vendedores/eliminar'
        ];

        if ($uri === '') { 
            $uri = '/'; 
        }

        $metodo = $_SERVER['REQUEST_METHOD'] ?? 'GET';

        $fn = null;

        if ($metodo === 'GET') {
            $fn = $this->rutasGET[$uri] ?? null;
        } else {
            $fn = $this->rutasPOST[$uri] ?? null;
        }

        // Proteger rutas antes de ejecutar controlador
        if (in_array($uri, $rutas_protegidas) && !$auth) {
            header('Location: /');
            exit;
        }

        // Si la ruta existe, ejecutar función
        if ($fn) {
            call_user_func($fn, $this);//nos premite llama una funcion cuando no sabemos como se llama la funcion
        } else {
            http_response_code(404);
            echo "404 - Página no encontrada.";
        }
    }

    // Renderizar vistas
    public function render($view, $datos = []) {

        foreach ($datos as $key => $value) {
            $$key = $value;//$$ significa variable de variable
        }

        // ROOT_DIR se define en includes/app.php
        if (!defined('ROOT_DIR')) {
            define('ROOT_DIR', dirname(__DIR__));
        }

        // basePath para prefijar enlaces y formularios (siempre termina con /)
        $scriptDir = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/')), '/');
        $basePath = ($scriptDir && $scriptDir !== '/') ? ($scriptDir . '/') : '/';

        // assetBase para estáticos (en este caso igual a basePath)
        $assetBase = $basePath;

        ob_start();//Inicia un almacenamiento en memoria
      // entonces incluimos la vista en el layout
        include __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean();//Limpiamos la memoria

        include ROOT_DIR . "/views/layout.php";
    }
}

?>
