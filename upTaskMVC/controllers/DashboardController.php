<?php

namespace  Controllers;

use Model\Proyecto;
use Model\Usuario;
use MVC\Router;


class DashboardController{
    public static function index(Router $router){
       isAuth();

       $id = $_SESSION['id'];
       $proyectos = Proyecto::belongsTo('propietarioId', $id);
       
        //REnder a la vista
        $router->render('dashboard/index', [
            'titulo' => 'Proyectos',
            'proyectos' => $proyectos,
            'basePath' => BASE_URL
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
                // header('Location: /proyecto?=' . $proyecto->url);
                redirect('proyecto?id=' . urlencode($proyecto->url));

            }
       }
        
        //REnder a la vista
        $router->render('dashboard/crear-proyecto', [
            'titulo' => 'Crear Proyectos',
            'alertas' => $alertas,
            'basePath' => BASE_URL


        ]);
    }

    public static function proyecto(Router $router){
        // $token = $_GET['id'];
        $token = $_GET['id'] ?? null;
        
        // if(!$token) header('Location: /dashboard');
        if(!$token) redirect('dashboard');
        
        //Revisar que la persona que visita el proyecto, es quien lo creo
        $proyecto = Proyecto::where('url', $token);
        
        if($proyecto->propietarioId !== $_SESSION['id']){
            // header('Location: /dashboard');
            redirect('dashboard');
        }
         
         //REnder a la vista
         $router->render('dashboard/proyecto', [
             'titulo' => $proyecto->proyecto,
             'proyectoId' => $proyecto->url,
            'basePath' => BASE_URL
 
         ]);
     }

    public static function perfil(Router $router){
        isAuth();
        $alertas = [];

       $usuario = Usuario::find($_SESSION['id']);

       if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validar_perfil();

            if(empty($alertas)){
                $existeUsuario = Usuario::where('email', $usuario->email);
                
                if($existeUsuario && $existeUsuario->id !== $usuario->id){
                    //Mensaje de Erro
                    Usuario::setAlerta('error', 'Email ya Registrado');
                    $alertas = $usuario->getAlertas();

                } else {
                    //Guardar el registro
                    $usuario->guardar();

                    Usuario::setAlerta('exito', 'Guardado Correctamente');
                    $alertas = $usuario->getAlertas();
    
                    //Asignar el nombre nuevo a la barra
                    $_SESSION['nombre'] = $usuario->nombre;
                }

            }
       }

        
        //REnder a la vista
        $router->render('dashboard/perfil', [
            'titulo' => 'Perfil',
            'usuario' => $usuario,
            'alertas' => $alertas,
            'basePath' => BASE_URL


        ]);
    }

    public static function cambiar_password(Router $router){
        isAuth();
        $alertas = [];


       if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario = Usuario::find($_SESSION['id']);

            //Sincronizar con los datos del usuario
            $usuario->sincronizar($_POST);

            $alertas = $usuario->nuevo_password();

            if(empty($alertas)){
                $resultado = $usuario->comprobar_password();

                if($resultado){
                    $usuario->password = $usuario->password_nuevo;
                    
                    //Eliminar Propiedades no necesarias
                    unset($usuario->password_actual);
                    unset($usuario->password_nuevo);

                    //Hashear el nuevo password
                    $usuario->hashPassword();

                    //Actualizar
                    $resultado = $usuario->guardar();

                    if($resultado){
                        Usuario::setAlerta('exito', 'Password Guardado Correctamente');
                        $alertas = $usuario->getAlertas();
                    }

                } else {
                    Usuario::setAlerta('error', 'Password Incorrecto');
                    $alertas = $usuario->getAlertas();
                }
            }
       }

        
        //REnder a la vista
        $router->render('dashboard/cambiar-password', [
            'titulo' => 'Cambiar Password',
            'alertas' => $alertas,
            'basePath' => BASE_URL

        ]);
    }
}

?>
