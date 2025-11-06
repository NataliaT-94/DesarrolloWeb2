<?php
namespace MVC;

class Router{

    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn){//tomas las url que  reaccionan con get, primer parametro la url y el segundo para,etro la funcion que cumple
      $this -> rutasGET[$url] = $fn;
    }
    public function post($url, $fn){//tomas las url que  reaccionan con get, primer parametro la url y el segundo para,etro la funcion que cumple
        $this -> rutasPOST[$url] = $fn;
    }

    public function comprobarRutas(){//valida que las rutas existan
      
      //session_start();
    //   $auth = $_SESSION['login'] ?? null;
            
      //$urlActual = $_SERVER['PATH_INFO'] ?? '/'; //lee la url actual
      $urlActual = strtok($_SERVER['REQUEST_URI'], '?') ?? '/';//elimina la parte del token de la url y detecta lapagina
      
      $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/'));
      $scriptDir = rtrim($scriptDir, '/');
      //$scriptDir contiene el directorio en el que se encuentra el script ejecutado, con formato limpio y sin barra final.
      
      // Si la urlActual comienza con ese directorio, lo removemos para obtener la ruta "lógica" de la app
      if ($scriptDir && $scriptDir !== '/' && strpos($urlActual, $scriptDir) === 0) {
          $urlActual = substr($urlActual, strlen($scriptDir)) ?: '/';
      }
      
      
      
      if ($urlActual === '') { $urlActual = '/'; }

      $metodo = $_SERVER['REQUEST_METHOD'] ?? 'GET';

      if($metodo === 'GET'){
        $fn = $this -> rutasGET[$urlActual] ?? NULL;//asociamos a que url se refiere la funcion, si no existe asignar null
      } else {

        $fn = $this -> rutasPOST[$urlActual] ?? NULL;
      }

      //Proteger las rutas
    //   if(in_array($urlActual, $rutas_protegidas) && !$auth){
    //     header('Location: /');
    //   }

      if($fn){
        //La URL existe y hay una funcion
        call_user_func($fn, $this);//nos premite llama una funcion cuando no sabemos como se llama la funcion
      } else {
        http_response_code(404);
        echo "404 - Página no encontrada.";
      }
    }
    
    //Muestra una vista
    public function render($view, $datos = []){

      foreach($datos as $key => $value){
        $$key = $value; //$$ significa variable de variable
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


      ob_start();//Inicia un almacenamiento en memoria
      // entonces incluimos la vista en el layout
      // include __DIR__ . "/views/$view.php";
      include ROOT_DIR . "/views/$view.php";

      $contenido = ob_get_clean();//Limpiamos la memoria
      // include __DIR__ . "/views/layout.php";
      include ROOT_DIR . "/views/layout.php";
    }
}

?>