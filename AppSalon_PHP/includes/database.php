<?php

//en este archivo colocamos las credenciales para conectarnos a la base de datos


//-----nuestra computadora, usuario, contraseña, base de datos
$db = mysqli_connect('localhost', 'root', '', 'appsalon');

if(!$db){//si hubo un error no se ejecuta nada
    echo "Hubo un ERROR";
    exit;
}