<?php
namespace MVC;

class Router{

    public $rutasGET = [];
    public $rutasPOST = [];
    public function get($url, $fn){
        $this->rutasGET[$url] = $fn;
    }

    public function post($url, $fn){
        $this->rutasPOST[$url] = $fn;
    }

    public function comprobarRutas(){
        // La sesión ya se inicia en public/index.php

            // URI sin querystring
        $uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';

        // Directorio donde está el script (index.php), p. ej. "/dev/nailsAppMVC/public"
        // Tomamos SOLO el directorio, no el archivo
        $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/'));
        $scriptDir = rtrim($scriptDir, '/');

        // Si la URI comienza con ese directorio, lo removemos para obtener la ruta "lógica" de la app
        if ($scriptDir && $scriptDir !== '/' && strpos($uri, $scriptDir) === 0) {
            $uri = substr($uri, strlen($scriptDir)) ?: '/';
        }

            // Normalizar
            if ($uri === '') { $uri = '/'; }

            $metodo = $_SERVER['REQUEST_METHOD'] ?? 'GET';

            if ($metodo === 'GET') {
                $fn = $this->rutasGET[$uri] ?? null;
            } else {
                $fn = $this->rutasPOST[$uri] ?? null;
            }

            if ($fn) {
                call_user_func($fn, $this);
            } else {
                http_response_code(404);
                echo "404 - Página no encontrada.";
            }
    }

    public function render($view, $datos = []){
        foreach($datos as $key => $value){
            $$key = $value;
        }

        // ROOT_DIR se define en includes/app.php
        if (!defined('ROOT_DIR')) {
            define('ROOT_DIR', dirname(__DIR__));
        }

        // basePath para prefijar enlaces y formularios (siempre termina con /)
        $scriptDir = rtrim(str_replace('\\','/', dirname($_SERVER['SCRIPT_NAME'] ?? '/')), '/');
        $basePath = ($scriptDir && $scriptDir !== '/') ? ($scriptDir . '/') : '/';

        // assetBase para estáticos (en este caso igual a basePath)
        $assetBase = $basePath;

        ob_start();
        include ROOT_DIR . "/views/$view.php";
        $contenido = ob_get_clean();

        include ROOT_DIR . "/views/layout.php";
    }

}


