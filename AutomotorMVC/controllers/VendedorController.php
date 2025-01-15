<?php

namespace Controllers;
use MVC\Router;
use Model\Vendedor;

class VendedorController{
    
    public static function index(Router $router) {
        $vendedores = Vendedor::all();

        // Muestra mensaje condicional
        $resultado = $_GET['resultado'] ?? null;

        $router->render('vendedores/index', [
            'vendedores' => $vendedores,
            'resultado' => $resultado
        ]);
    }

    public static function crear(Router $router){
        $errores = Vendedor::getErrores();
        $vendedor = new Vendedor;
        
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //Crear una nueva instancia
        $vendedor = new Vendedor($_POST['vendedor']);

        //Validar que no haya campos vacios
        $errores = $vendedor -> validar();

        //No hay errores
        if(empty($errores)){
                // Guarda en la base de datos
                $resultado = $vendedor->guardar();
            
            if($resultado) {
                header('location: /vendedores');
            }
        }
    }

        $router -> render('vendedores/crear', [
            'errores' => $errores,
            'vendedor' => $vendedor
        ]);
    }

    public static function actualizar(Router $router){
        $errores = Vendedor::getErrores();
        $id = validarORedireccionar('/admin');

        //Obtener datos dek vendedor a actualizar
        $vendedor = Vendedor::find($id);

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //Asignar los valores
            $args = $_POST['vendedor'];

            //Sincronizar objeto en memoria con lo que el usuario escribio
            $vendedor -> sincronizar($args);

            //Validacion
            $errores = $vendedor -> validar();

            if(empty($errores)){
                $resultado = $vendedor -> guardar();

                if($resultado) {
                    header('location: /admin');
                }
            }
        }

        $router->render('vendedores/actualizar',[
            'errores' => $errores,
            'vendedor' => $vendedor
        ]);
    }

    public static function eliminar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //Validar id
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id){
                //Valida el tipo a eliminar
                $tipo = $_POST['tipo'];

                if(validarTipoContenido($tipo)){
                    $vendedor = Vendedor::find($id);
                    $vendedor -> eliminar();
                    header('location: /admin');
                }
            }

    
        }
    }
}



?>
