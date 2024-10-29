<?php

define('TEMPLATES_URL', __DIR__. '/templates');//__DIR__ permite completar la ruta para poder acceder a templates, hay que entrar a la carpeta por eso lleva /
define('FUNCIONES_URL', __DIR__ . '/includes/funciones.php');
// esta en el mismo nivel que app.php, por eso no lleva /
define('CARPETA_IMAGENES', __DIR__ . '/../imagenes/');

 
function incluirTemplate(string $nombre, bool $inicio = false ){
    //include "includes/templates/${nombre}.php";
    include TEMPLATES_URL . "/$nombre.php";
}


function estaAutenticado() {
    session_start();

    if(!$_SESSION['login']){
        header('Location:http://localhost/GitHub/DesarrolloWeb2/bienesraices_inicio/index.php');
    }
}

function debuguear($variable){
    
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";

    exit;
}

//Sanitizar el HTML
function s($html) : string{
    $s = htmlspecialchars($html);
    return $s;
}

