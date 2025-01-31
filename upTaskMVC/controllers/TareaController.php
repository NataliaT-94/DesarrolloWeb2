<?php

namespace  Controllers;

use Model\Tarea;
use Model\Proyecto;


class TareaController{

    public static function index(){
        $proyectoId = $_GET['id'];
        
        
        if(!$proyectoId) header('Location: /dashboard');
  

        $proyecto = Proyecto::where('url', $proyectoId);

        if(!$proyecto || $proyecto->propietarioId !== $_SESSION['id']) header('Location: /404');

  
        $tareas = Tarea::belongsTo('proyectoId', $proyecto->id);
        // debuguear($tareas);
        echo json_encode(['tareas' => $tareas]);
        
    }
    
    public static function crear(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $proyectoId = $_POST['proyectoId'];
            $proyecto = Proyecto::where('url', $proyectoId);

            if(!$proyecto || $proyecto->propietarioId !== $_SESSION['id']){
                $respuesta = [
                    'tipo' => 'error',
                    'mensaje' => 'Hubo un Error al agregar la Tarea'
                ];
                echo json_encode($respuesta);
                return;
            }

            //instanciar y crear la tarea
            $tarea = new Tarea($_POST);
            $tarea->proyectoId = $proyecto->id;
            $resultado = $tarea->guardar();
            $respuesta = [
                'tipo' => 'exito',
                'id' => $resultado['id'],
                'mensaje' => 'Tarea creada Correctamente',
                'proyectoId' => $proyecto->id
            ];

            echo json_encode($respuesta);

        }


    }
    public static function actualizar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

        }
    }
    public static function eliminar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

        }

    }

}


?>