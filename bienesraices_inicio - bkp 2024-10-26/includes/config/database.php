<?php
function conectarDB() : mysqli {
    // Intenta establecer la conexión con la base de datos
    $db = mysqli_connect('localhost', 'root', '', 'bienesraices_crud');

    // Verifica si la conexión fue exitosa
    if(!$db){
    //     echo "Conexión exitosa a la base de datos.";
    //     return $db; // Retorna la conexión para usarla posteriormente
    // } else {
        // Si la conexión falla, muestra el error específico
        echo "No se pudo conectar a la base de datos: " . mysqli_connect_error();
        exit; // Detiene la ejecución del script
    }
    return $db;
}
?>
