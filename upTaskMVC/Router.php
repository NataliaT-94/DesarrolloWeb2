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
      
      session_start();
    //   $auth = $_SESSION['login'] ?? null;
      
    //   //Arreglo de rutas protegidas...
    //    $rutas_protegidas = ['/admin', '/vehiculos/crear',  '/vehiculos/actualizar',  '/vehiculos/eliminar', '/vendedores/crear',  '/vendedores/actualizar',  '/vendedores/eliminar' ];
      
      
      //$urlActual = $_SERVER['PATH_INFO'] ?? '/'; //lee la url actual
      $urlActual = strtok($_SERVER['REQUEST_URI'], '?') ?? '/';//elimina la parte del token de la url y detecta lapagina
      $metodo = $_SERVER['REQUEST_METHOD'];

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

        echo "404 - Página no encontrada.";
      }
    }
    
    //Muestra una vista
    public function render($view, $datos = []){

      foreach($datos as $key => $value){
        $$key = $value; //$$ significa variable de variable
      }

      ob_start();//Inicia un almacenamiento en memoria
      // entonces incluimos la vista en el layout
      include __DIR__ . "/views/$view.php";

      $contenido = ob_get_clean();//Limpiamos la memoria
      include __DIR__ . "/views/layout.php";
    }
}

?>