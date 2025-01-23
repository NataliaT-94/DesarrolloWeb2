<?php
$db = mysqli_connect('localhost', 'root', '', 'uptaskmvc');

if(!$db){
    echo "Error: No se pudo conectar a MySQL.";
    echo "errno de depuracion: " . mysqli_connect_errno();
    echo "error de depuracion: " . mysqli_connect_error();
    exit;
}

?>