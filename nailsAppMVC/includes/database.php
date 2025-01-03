<?php

$db = mysqli_connect('localhost', 'root', '', 'nailsAppMVC');

if(!$db){
    echo "Error: No se pudo conectar a MySQL.";
    echo "Errno de Depuracion: " . mysqli_connect_errno();
    echo "Error de Depuracion: " . mysqli_connect_error();
    exit;
}

?>