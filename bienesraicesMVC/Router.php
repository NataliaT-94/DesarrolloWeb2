<?php

namespace MVC;

class Router{

    public $rutasGET =[];
    public $rutasPOST =[];

    public function get($url, $fn){//tomas las url que reaccionan con get, primer parametro la url y el segundo para,etro la funcion que cumple
        $this -> rutasGET[$url] = $fn;
    }

    public function comprobarRutas(){//valida que las rutas existan
      $urlActual = $_SERVER['PATH_INFO'] ?? '/'; //lee la url actual
      $metodo = $_SERVER['REQUEST_METHOD'];

      if($metodo === 'GET'){
        $fn = $this -> rutasGET[$urlActual] ?? NULL;//asociamos a que url se refiere la funcion, si no existe asignar null
      }
      if($fn){
        //La URL existe y hay una funcion
        call_user_func($fn, $this);//nos premite llama una funcion cuando no sabemos como se llama la funcion
      } else {
        echo "Pagina No Encontrada";
      }
    }

    //Muestra una vista
    public function render($view){
      ob_start();//Inicia un almacenamiento en memoria
      include __DIR__ . "/views/$view.php";

      $contenido = ob_get_clean();//Limpiamos la memoria
      include __DIR__ . "/views/layout.php";
    }
}


?>