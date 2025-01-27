<?php

namespace  Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController{
    public static function login(Router $router){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarLogin();

            if(empty($alertas)){
                //Varificar que el Usuario exista
                $usuario = Usuario::where('email', $usuario->email);
            
                if(!$usuario || !$usuario->confirmado){
                    Usuario::setAlerta('error', 'El Usuario No Existe o No esta Confirmado');
                } else {
                    //El usuario Existe
                    if(password_verify($_POST['password'], $usuario->password)){
                        //Iniciar sesion
                        session_start();
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;

                        //Redireccionar
                        header('Location: /dashboard');

                    } else {
                        Usuario::setAlerta('error', 'Password Incorrecto');
                    }
                }
            }
        }

        $alertas = Usuario::getAlertas();

        //REnder a la vista
        $router->render('auth/login', [
            'titulo' => 'Iniciar Sesion',//lo visualizas en el layout en el titulo
            'alertas' => $alertas
        ]);//primer parametro nombre de la carpeta donde se encuentra, segundo se le pasa el arreglo de informacion
    }
    
    public static function logout(){
        $_SESSION = [];
        header('Location: /');
        
        
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
                    $email = new Email($usuario->nombre, $usuario->email, $usuario->token);
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
                //Buscar el ususario
                $usuario = Usuario::where('email', $usuario->email);

                if($usuario && $usuario->confirmado){
                    //Generar un nuevo token
                    $usuario->crearToken();
                    unset($usuario->password2);
             
                    //Actualizar el usuario
                    $usuario->guardar();

                    //Enviar el email
                    $email = new Email($usuario->nombre, $usuario->email, $usuario->token);
                    $email->enviarInstrucciones();

                    //Imprimir la alerta
                    Usuario::setAlerta('exito', 'Hemos enviado las instrucciones a tu email');

                } else {
                    Usuario::setAlerta('error', 'El Usuario no existe o no esta confirmado');

                }
            }
        }
        $alertas = Usuario::getAlertas();

        //REnder a la vista
        $router->render('auth/olvide', [
            'titulo' => 'Olvide mi Password',
            'alertas' => $alertas
        ]);
    }

    public static function reestablecer(Router $router){
        $token = s($_GET['token']);
        $mostrar = true;
        
        if(!$token) header('Location: /');

        //Identificar el usuario con este token
        $usuario = Usuario::where('token', $token);

        if(empty($usuario)){
            Usuario::setAlertas('error', 'Token No Valido');
            $mostrar = false;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //Añadir el nuevo password
            $usuario->sincronizar($_POST);

            //Validar el password
            $alertas = $usuario->validarPassword();

            if(empty($alertas)){
                //Hashear el nievo password
                $usuario->hashPassword();

                //Eliminar el token
                $usuario->token = null;
                unset($usuario->password2);

                //Guardar el usuario en la BD
                $resultado = $usuario->guardar();

                //REdireccionar
                if($resultado){
                    header('Location: /');
                }
            }
            
        }
        $alertas = Usuario::getAlertas();

        //REnder a la vista
        $router->render('auth/reestablecer', [
            'titulo' => 'Reestablecer Password', 
            'alertas' => $alertas,
            'mostrar' => $mostrar
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