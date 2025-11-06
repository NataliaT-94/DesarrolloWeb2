<?php

namespace MVC;

class Router
{
    public array $getRoutes = [];
    public array $postRoutes = [];
    protected string $currentUrl = '/';

    public function get($url, $fn)
    {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    public function comprobarRutas()
    {

        // $url_actual = $_SERVER['PATH_INFO'] ?? '/';
        $url_actual = strtok($_SERVER['REQUEST_URI'], '?') ?? '/';//elimina la parte del token de la url y detecta lapagina
      
        $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/'));
        $scriptDir = rtrim($scriptDir, '/');

            // Si la url_actual comienza con ese directorio, lo removemos para obtener la ruta "lógica" de la app
      if ($scriptDir && $scriptDir !== '/' && strpos($url_actual, $scriptDir) === 0) {
          $url_actual = substr($url_actual, strlen($scriptDir)) ?: '/';
      }

        if ($url_actual === '') { $url_actual = '/'; }

        $this->currentUrl = $url_actual; // <-- guardamos para render()

        $metodo = $_SERVER['REQUEST_METHOD'] ?? 'GET';

        if($metodo === 'GET'){
            $fn = $this -> getRoutes[$url_actual] ?? NULL;//asociamos a que url se refiere la funcion, si no existe asignar null
        } else {

            $fn = $this -> postRoutes[$url_actual] ?? NULL;
        }

        if ($fn) {
            call_user_func($fn, $this);
        } else {
            http_response_code(404);
            echo "404 - Página no encontrada.";
        }
   }

    public function render($view, $datos = [])
    {
        foreach ($datos as $key => $value) {
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

        include_once ROOT_DIR . "/views/$view.php";

        $contenido = ob_get_clean(); // Limpia el Buffer

        // include ROOT_DIR . "/views/layout.php";

        if (str_contains($this->currentUrl, 'admin')){//sirve para verificar si la url_actual contiene admin
            include_once ROOT_DIR . '/views/admin-layout.php';
        } else {
            include_once ROOT_DIR . '/views/layout.php';
        }

    }
}
