<?php 
namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email{

    public $nombre;
    public $email;
    public $token;

    public function __construct($nombre, $email, $token){
        $this->nombre = $nombre;
        $this->email = $email;
        $this->token = $token;
    }

    public function enviarConfirmacion(){
       //Crear el objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '035b486eecc490';
        $mail->Password = '91e94a2d08d858'; 

        $mail->setFrom('cuentas@nailsapp.com');
        $mail->addAddress('cuentas@nailsapp.com', 'NailsApp.com');
        $mail->Subject = 'Confirma tu Cuenta';

        //Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido = "<p><strong>Hola " . $this->nombre . "</strong> Has creado tu cuenata en Nails App, solo debes confirmarla presionando el siguiente enlace</p>";
        $contenido .= "<p>Presiona aqui: <a href='http://localhost:3000/confirmar-cuenta?token=" . $this->token ."'>Confirmar Cuenta</a> </p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        //Enviar el mail
        $mail->send();
    }

    public function enviarInstrucciones(){
        //Crear el objeto de email
// Looking to send emails in production? Check out our Email API/SMTP product!
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '035b486eecc490';
        $mail->Password = '91e94a2d08d858';

        $mail->setFrom('cuentas@nailsapp.com');
        $mail->addAddress('cuentas@nailsapp.com', 'NailsApp.com');
        $mail->Subject = 'Reestablece tu Contraseña';

        //Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido = "<p><strong>Hola " . $this->nombre . "</strong> Has solicitado reestablecer tu Contraseña, sigue el siguiente enlace pa hacerlo</p>";
        $contenido .= "<p>Presiona aqui: <a href='http://localhost:3000/recuperar?token=" . $this->token ."'>Reestablecer Contraseña</a> </p>";
        $contenido .= "<p>Si tu no solicitaste este cambio, puedes ignorar el mensaje</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        //Enviar el mail
        $mail->send();
    }

}

?>