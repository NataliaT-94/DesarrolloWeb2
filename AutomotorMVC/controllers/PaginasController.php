<?php

namespace Controllers;

use MVC\Router;
use Model\Vehiculo;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController{
    public static function index(Router $router){
        
        $vehiculos = Vehiculo::get(3);
        $inicio = true;


        $router -> render('paginas/index', [
            'vehiculos' => $vehiculos,
            'inicio' => $inicio
        ]);
    }
    public static function nosotros(Router $router){


        $router -> render('paginas/nosotros', [

        ]);
    }
    public static function vehiculos(Router $router){
        
        $vehiculos = vehiculo::all();

        $router -> render('paginas/vehiculos', [
            'vehiculos' => $vehiculos
        ]);
    }
    public static function vehiculo(Router $router){
        
        $id = validarORedireccionar('/vehiculos');

        //Buscar el vehiculo por su id
        $vehiculo = Vehiculo::find($id);

        $router -> render('paginas/vehiculo', [
            'vehiculo' => $vehiculo
        ]);
    }
    public static function blog(Router $router){

        $router -> render('paginas/blog', [
        
        ]);
    }
    public static function entrada(Router $router){
        
        $router -> render('paginas/entrada', [
        
        ]);
    }
    public static function contacto(Router $router){
        $mensaje = null;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            $respuestas = $_POST['contacto'];

            //Crear una instancia de PHPMailer
            $mail = new PHPMailer();

            //Configurar SMTP
            $mail -> isSMTP();
            $mail -> Host = 'sandbox.smtp.mailtrap.io';
            $mail -> SMTPAuth = true;
            $mail -> Username = '035b486eecc490';
            $mail -> Password = '********d858';
            $mail -> SMTPSecure = 'tls';
            $mail -> Port = 2525;

            //Configurar el contenido del email
            $mail -> setFrom('admin@automotormvc.com'); //quien envia el email
            $mail -> addAddress('admin@automotormvc.com', 'automotormvc.com'); //quien recibe el email
            $mail -> Subject = 'Tienes un Nuevo Mensaje'; //Es el mensaje que llega cuando tenemos un nuevo email

            //Habilitar HTML
            $mail -> isHTML(true);
            $mail -> CharSet = 'UTF-8';

            //Definir el contenido
            $contenido = '<html>'; 
            $contenido .= '<p>Tienes un Nuevo Mensaje</p>';
            $contenido .= '<p>Nombre: ' . $respuestas['nombre'] . '</p>';
            $contenido .= '<p>Mensaje: ' . $respuestas['mensaje'] . '</p>';
            $contenido .= '<p>Vende o Compra: ' . $respuestas['tipo'] . '</p>';
            $contenido .= '<p>Precio o Presupuesto: $' . $respuestas['precio'] . '</p>';
            $contenido .= '<p>Prefiere ser contactado por: ' . $respuestas['contacto'] . '</p>';


            //Enviar de forma condicional algunos campos de email o telefono
            if($respuestas['contacto'] === 'telefono'){
                $contenido .= '<p>Eligio ser contactado por Telefono:</p>';
                $contenido .= '<p>Telefono: ' . $respuestas['telefono'] . '</p>';
                $contenido .= '<p>Fecha contacto: ' . $respuestas['fecha'] . '</p>';
                $contenido .= '<p>Hora: ' . $respuestas['hora'] . '</p>';
    
            } else {
                //Es email, entonces agregarmos el campo de email
                $contenido .= '<p>Eligio ser contactado por Email:</p>';
                $contenido .= '<p>Email: ' . $respuestas['email'] . '</p>';

            }

            $contenido .= '</html>';

            $mail -> Body = $contenido;
            $mail -> AltBody = 'Esto es texto alternativo sin HTML';

            //Enviar el email
            if($mail -> send()){
                $mensaje = "Mensaje enviado Correctamente";
            } else {
                $mensaje = "El mensaje no se pudo enviar..";
            }
        }

        $router -> render('paginas/contacto', [
            'mensaje' => $mensaje
        ]);
    }

}


?>