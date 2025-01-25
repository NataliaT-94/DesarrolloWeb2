<?php

namespace  Controllers;

use Classes\Email;
use Model\Usuario;
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
        $alertas = [];
        $usuario = new Usuario;//instanciar el usuario

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario->sincronizar($_POST);

            // debuguear($usuario);
            $alertas = $usuario->validarNuevaCuenta();

            // debuguear($alertas);
            if(empty($alertas)){
                $existeUsuario = Usuario::where('email', $usuario->email);
                // debuguear($existeUsuario);
    
                if($existeUsuario){
                    Usuario::setAlerta('error', 'El Usuario ya esta registrado');
                    $alertas = Usuario::getAlertas();
                } else {
                    //Hasheando el password
                    $usuario->hashPassword();

                    //Eliminar password2
                    unset($usuario->password2);

                    //Generar Token
                    $usuario->crearToken();

                    //Crear nuevo Usuario
                    $resultado = $usuario->guardar();

                    //Enviar email
                    $email = new Email($usuario->$email, $usuario->$nombre, $usuario->$token);
                    $email->enviarConfirmacion();

                    if($resultado){
                        header('Location: /mensaje');
                    }
                }
            }

        
        }

        //REnder a la vista
        $router->render('auth/crear', [
            'titulo' => 'Crea tu Cuenta',
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function olvide(Router $router){
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarEmail();

            if(empty($alertas)){

            }
        }

        //REnder a la vista
        $router->render('auth/olvide', [
            'titulo' => 'Olvide mi Password',
            'alertas' => $alertas
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
        $alertas = [];
        $token = s($_GET['token']);
        // debuguear($token);

        if(!$token) header('Location: /');

        //Encontrar al usuario con este token
        $usuario = Usuario::where('token', $token);
        debuguear($usuario);

        if(empty($usuario)){
            //No se encontro un usuario con ese token
            Usuario::setAlerta('error', 'Token No Valido');
        } else {
            //Confirmar la cuenta
            $usuario->confirmado = "1";
            $usuario->token = null;
            unset($usuario->password2);
            // debuguear($usuario);

            //Guardar en la BD
            $usuario->guardar();

            Usuario::setAlerta('exito', 'Cuenta Comprobada Correctamente');
        }

        $alertas = Usuario::getAlertas();

        //REnder a la vista
        $router->render('auth/confirmar', [
            'titulo' => 'Confirma tu cuenta UpTask',
            'alertas' => $alertas
        ]);
        
    }

}



?>