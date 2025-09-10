<?php 
namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email{
    protected $nombre;
    protected $email;
    protected $token;

    public function __construct($nombre, $email, $token)
    {
        $this->nombre = $nombre;
        $this->email = $email;
        $this->token = $token;
    }

    public function enviarConfirmacion(){


        // Looking to send emails in production? Check out our Email API/SMTP product!
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];
        
        $mail->setFrom('prueba@automotor.com');//quien evia el email
        $mail->addAddress('prueba@automotor.com', 'prueba.com');//quien recibe
        $mail->Subject = 'Confirma tu Cuenta';//el mensaje que llega, lo primero que se lee cuando llega el mensaje


        $mail-> isHTML(TRUE);
        $mail->CharSet = 'UTF-8';


        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Has creado tu cuenata en Automotor, solo debes confirmarla presionando el siguiente enlace</p>";
        $contenido .= "<p>Presiona aqui: <a href='" . $_ENV['APP_URL'] . "/confirmar-cuenta?token=" . $this->token ."'>Confirmar Cuenta</a> </p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje</p>";
        $contenido .= "</html>";


        $mail->Body = $contenido;

        //Enviar el email
        $mail->send();

    }
    
    public function enviarInstrucciones(){
        //Crear el objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];
        
        $mail->setFrom('prueba@automotor.com');//quien evia el email
        $mail->addAddress('prueba@automotor.com', 'prueba.com');//quien recibe
        $mail->Subject = 'Confirma tu Cuenta';//el mensaje que llega, lo primero que se lee cuando llega el mensaje

        //Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido = "<p><strong>Hola " . $this->nombre . "</strong> Has solicitado reestablecer tu Contraseña, sigue el siguiente enlace pa hacerlo</p>";
        $contenido .= "<p>Presiona aqui: <a href='" . $_ENV['APP_URL'] . "/recuperar?token=" . $this->token ."'>Reestablecer Contraseña</a> </p>";
        $contenido .= "<p>Si tu no solicitaste este cambio, puedes ignorar el mensaje</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        //Enviar el mail
        $mail->send();
    }

}

?>