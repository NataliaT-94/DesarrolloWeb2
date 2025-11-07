<?php

namespace Controllers;

use Model\Dia;
use Model\Hora;
use MVC\Router;
use Model\Evento;
use Model\Regalo;
use Model\Paquete;
use Model\Ponente;
use Model\Usuario;
use Model\Registro;
use Model\Categoria;
use Model\EventosRegistros;
use Soap\Url;

class RegistroController {
    public static function crear(Router $router){
        if(!is_auth()){
            // header('Location: /');
            redirect('');
            return;
        }

        //Verificar si el usuario ya esta registrado
        $registro = Registro::where('usuario_id', $_SESSION['id']);
        
        if(isset($registro) && ($registro->paquete_id === "3" || $registro->paquete_id === "2")){
            redirect('boleto?id=' . urlencode($registro->token));
            return;
        }

        if(isset($registro) && $registro->paquete_id === "1"){
            redirect('/finalizar-registro/conferencias');
            return;
        }

        $router->render('registro/crear', [
            'titulo' => 'Finalizar Registro'
        ]);
    }

    public static function gratis(Router $router){

        if($_SERVER['REQUEST_METHOD'] ==='POST'){
            if(!is_auth()){
                // header('Location: /login');
                redirect('login');
                return;
            }
            
            //Verificar si el usuario ya esta registrado
            $registro = Registro::where('usuario_id', $_SESSION['id']);
            
            if(isset($registro) && $registro->paquete_id === "3"){ //si el usuario ya esta registrado y tiene el plan gratis, se redirecciona directamente al ticket
               
                redirect('boleto?id=' . urlencode($registro->token));
                return;
            }

            $token = substr(md5(uniqid(rand(), true)), 0, 8);//acorta el token a 8 caracteres
            
            //Crear Registro
            $datos = [
                'paquete_id' => 3,
                'pago_id' => '',
                'token' => $token,
                'usuario_id' => $_SESSION['id']
            ];

            $registro = new Registro($datos);
            $resultado = $registro->guardar();

            if($resultado){
            
                redirect('boleto?id=' . urlencode($registro->token));
                return;
            }
        }

    }

    public static function boleto(Router $router){

        //Validar la URL
        $id = $_GET['id'];

        if(!$id || !strlen($id) === 8){
            // header('Location: /');
            redirect('');
            return;
            
        }

        //Buscarlo en BD
        $registro = Registro::where('token', $id);
        if(!$registro){
            // header('Location: /');
            redirect('');
            return;
        }

        //Llenar las tablas de referencia
        $usuario = Usuario::find($registro->usuario_id);
        $paquete = Paquete::find($registro->paquete_id);

        // debuguear($registro);

        $router->render('registro/boleto', [
            'titulo' => 'Asistencia a DevWebCamp',
            'registro' => $registro,
            'usuario' => $usuario,
            'paquete' => $paquete
        ]);
    }

    public static function pagar(Router $router){

        if($_SERVER['REQUEST_METHOD'] ==='POST'){
            if(!is_auth()){
                // header('Location: /login');
                redirect('login');
                return;
            }

            //Validar que post no venga vacio
            if(empty($_POST)){
                // echo json_encode([]);
                // header('Location: /finalizar-registro');
                redirect('/finalizar-registro');
                return;
            }

            //Crear registro
            
            $datos = $_POST;
            $datos['token'] = substr(md5(uniqid(rand(), true)), 0, 8);
            $datos['usuario_id'] = $_SESSION['id'];

            // debuguear($datos);


            // if($resultado){
            //     header('Location: /boleto?id=' . urlencode($registro->token));
            // }

            try{

                $registro = new Registro($datos);
                $resultado = $registro->guardar();
                // echo json_encode($resultado);

                if ($resultado) {
                    // Si el paquete es presencial (1), redirige a conferencias

                    
                    if ($registro->paquete_id === "1") {
                        // header('Location: /finalizar-registro/conferencias');
                        redirect('/finalizar-registro/conferencias');

                        return;
                    }

                    // Si el paquete es virtual (2), redirige al boleto directamente
                    if ($registro->paquete_id === "2") {
                        redirect('boleto?id=' . urlencode($registro->token));
                        return;
                    }
                } else {
                    // header('Location: /finalizar-registro');
                    redirect('/finalizar-registro');
                    return;
                }


            } catch (\Throwable $th){
                // echo json_encode([
                //     'resultado' => 'error'
                // ]);

                // header('Location: /finalizar-registro');
                redirect('/finalizar-registro');
            }
        }
    }
    
    public static function conferencias(Router $router){
        if(!is_auth()){
            // header('Location: /login');
            redirect('login');
            return;
        }

        //Validar que el usuario tenga el plan presencial
        $usuario_id = $_SESSION['id'];
        $registro = Registro::where('usuario_id', $usuario_id);

        if(isset($registro) && $registro->paquete_id === "2"){
            redirect('boleto?id=' . urlencode($registro->token));
            return;
        }

        if(!isset($registro) || $registro->paquete_id !== "1"){
            redirect('');
            return;
        }

        // //Redireccionar a boleto virtual en caso de haber finalizado su registro
        // if(isset($registro->regalo_id) && $registro->paquete_id === "1"){
        //     redirect('boleto?id=' . urlencode($registro->token));
        //     return;
        // }

        $eventos = Evento::ordenar('hora_id', 'ASC');

        $eventos_formatedos = [];
        foreach($eventos as $evento){
            $evento->categoria = Categoria::find($evento->categoria_id);//con esto podemos imprimir el nombre de la categoria en la tabla, en ves de mostrar el numero del id
            $evento->dia = Dia::find($evento->dia_id);
            $evento->hora = Hora::find($evento->hora_id);
            $evento->ponente = Ponente::find($evento->ponente_id);
            
            if($evento->dia_id === "1" && $evento->categoria_id === "1"){
                $eventos_formatedos['conferencias_v'][] = $evento;                
            }

            if($evento->dia_id === "2" && $evento->categoria_id === "1"){
                $eventos_formatedos['conferencias_s'][] = $evento;
            }

            if($evento->dia_id === "1" && $evento->categoria_id === "2"){
                $eventos_formatedos['workshops_v'][] = $evento;                
            }

            if($evento->dia_id === "2" && $evento->categoria_id === "2"){
                $eventos_formatedos['workshops_s'][] = $evento;
            }
        }

        $regalos = Regalo::all('ASC');

        //Manejando el registro mediante el $_POST
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            //Revisar que el usuario este autentificado
            if(!is_auth()){
                // header('Location: /login');
                redirect('login');
                return;
            }

            $eventos = explode(',', $_POST['eventos']);
            if(empty($eventos)){
                echo json_encode(['resultado' => false]);
                return;
            }

            //Obtener el registrp de usuario
            $registro = Registro::where('usuario_id', $_SESSION['id']);
            if(!isset($registro) || $registro->paquete_id !== "1"){
                echo json_encode(['resultado' => false]);
                return;
            }
            
            $eventos_array =[];
            //Validar la disponibilidad de los eventos seleccionados
            foreach($eventos as $evento_id){
                $evento = Evento::find($evento_id);

                //Comprobar que el evento exista
                if(!isset($evento) || $evento->disponibles == "0"){
                    echo json_encode(['resultado' => false]);
                    return;
                }
                $eventos_array[] = $evento;
            }
            foreach($eventos_array as $evento){
                $evento->disponibles -= 1;
                $evento->guardar();
            
                $datos = [
                    'evento_id' => (int) $evento->id,
                    'registro_id' => (int) $registro->id
                ];
            
                $registro_usuario = new EventosRegistros($datos);
                $registro_usuario->guardar();
            }
            
            // Almacenar el regalo solo una vez
            $registro->sincronizar(['regalo_id' => $_POST['regalo_id']]);
            $resultado = $registro->guardar();
            
            echo json_encode([
                'resultado' => $resultado,
                'token' => $registro->token
            ]);
            return;
            
        }

        $router->render('registro/conferencias', [
            'titulo' => 'Elige Workshops y Conferencias',
            'eventos' => $eventos_formatedos,
            'regalos' => $regalos
        ]);
    }


}


?>