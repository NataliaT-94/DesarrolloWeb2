<?php
$db = mysqli_connect($_ENV['BD_HOST'], $_ENV['BD_USER'], $_ENV['BD_PASS'], $_ENV['BD_NAME']);

if(!$db){
    echo "Error: No se pudo conectar a MySQL.";
    echo "errno de depuracion: " . mysqli_connect_errno();
    echo "error de depuracion: " . mysqli_connect_error();
    exit;
}

?>