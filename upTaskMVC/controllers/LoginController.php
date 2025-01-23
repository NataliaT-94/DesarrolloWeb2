<?php

namespace  Controllers;

use MVC\Router;

class LoginController{
    public static function login(Router $router){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
        }

        //REnder a la vista
        $router->render('auth/login', [
            'titulo' => 'Iniciar Sesion'//lo visualizas en el layout en el titulo
        ]);//primer parametro nombre de la carpeta donde se encuentra, segundo se le pasa el arreglo de informacion
    }
    
    public static function logout(){
        echo "Desde logout";
        
        
    }

    public static function crear(Router $router){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
        }

        //REnder a la vista
        $router->render('auth/crear', [
            'titulo' => 'Crea tu Cuenta'
        ]);
    }

    public static function olvide(Router $router){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
        }

        //REnder a la vista
        $router->render('auth/olvide', [
            'titulo' => 'Olvide mi Password'
        ]);
    }

    public static function reestablecer(Router $router){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
        }

        //REnder a la vista
        $router->render('auth/reestablecer', [
            'titulo' => 'Reestablecer Password'
        ]);
    }

    public static function mensaje(Router $router){

        //REnder a la vista
        $router->render('auth/mensaje', [
            'titulo' => 'Cuenta Creada Exitosamente'
        ]);
        
    }

    public static function confirmar(Router $router){

        //REnder a la vista
        $router->render('auth/confirmar', [
            'titulo' => 'Confirma tu cuenta UpTask'
        ]);
        
    }

}



?>