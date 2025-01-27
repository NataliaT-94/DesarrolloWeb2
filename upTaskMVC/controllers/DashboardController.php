<?php

namespace  Controllers;

use Model\Proyecto;
use MVC\Router;


class DashboardController{
    public static function index(Router $router){
       isAuth();

       $id = $_SESSION['id'];
       $proyectos = Proyecto::belongsTo('propietarioId', $id);
       
        
        //REnder a la vista
        $router->render('dashboard/index', [
            'titulo' => 'Proyectos',
            'proyectos' => $proyectos


        ]);
    }

    public static function crear_proyecto(Router $router){
       isAuth();

       $alertas = [];

       if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $proyecto = new Proyecto($_POST);

            //Validacion
            $alertas = $proyecto->validarProyecto();

            if(empty($alertas)){
                //Generar un URL unica
                $hash = md5(uniqid());
                $proyecto->url = $hash;

                //Almacen el creador del proyecto
                $proyecto->propietarioId = $_SESSION['id'];

                //Guardar el Proyecto
                $proyecto->guardar();

                //Redireccionar
                header('Location: /proyecto?=' . $proyecto->url);
            }
       }
        
        //REnder a la vista
        $router->render('dashboard/crear-proyecto', [
            'titulo' => 'Crear Proyectos',
            'alertas' => $alertas


        ]);
    }

    public static function proyecto(Router $router){
        $token = $_GET['id'];
        
        if(!$token) header('Location: /dashboard');
        
        //Revisar que la persona que visita el proyecto, es quien lo creo
        $proyecto = Proyecto::where('url', $token);
        
        if($proyecto->propietarioId !== $_SESSION['id']){
            header('Location: /dashboard');
        }
         
         //REnder a la vista
         $router->render('dashboard/proyecto', [
             'titulo' => $proyecto->proyecto
 
         ]);
     }

    public static function perfil(Router $router){
       
        
        //REnder a la vista
        $router->render('dashboard/perfil', [
            'titulo' => 'Perfil'


        ]);
    }
}

?>
