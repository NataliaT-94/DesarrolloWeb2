<?php

$archivo = "hola.txt";
$contenido = "Hola Mundo";

// Intentar escribir el archivo
if (file_put_contents($archivo, $contenido)) {
    echo "Archivo creado correctamente: $archivo";
} else {
    echo "Error: No se pudo crear el archivo";
}