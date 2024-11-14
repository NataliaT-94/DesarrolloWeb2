<?php
namespace Controllers;
use MVC\Router;

class AutomotorController{
    public static function index(Router $router){
        $router -> render('vehiculos/admin');
    }
    public static function crear(){
        echo "crear";
    }
    public static function actualizar(){
        echo "actualizar";
    }
}
?> 