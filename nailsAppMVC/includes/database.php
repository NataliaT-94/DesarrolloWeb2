<?php
function conectarDB() : mysqli {
    // Intenta establecer la conexión con la base de datos
    $db = new mysqli($_ENV['BD_HOST'], $_ENV['BD_USER'], $_ENV['BD_PASS'], $_ENV['BD_NAME']);

    // Verifica si la conexión fue exitosa
    if(!$db){
        // Si la conexión falla, muestra el error específico
        echo "No se pudo conectar a la base de datos: " . mysqli_connect_error();
        exit; // Detiene la ejecución del script
    }
    return $db;
}
?>
