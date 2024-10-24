<?php

//Conectar a la BD con PDO

//PDO soporta varias base de datos

$db = new PDO('mysql:host=localhost; dbname=bienesraices_crud', 'root', '');

    //Creamos el query
$query = "SELECT titulo, imagen FROM propiedades";

    //Consultar la BD
// $propiedades = $db -> query($query) -> fetch();//fetchAll,fetchColumn, fetchObject

    //Lo preparamos
$stmt = $db -> prepare($query);

    //Lo ejecutamos
$stmt -> execute();

    //Obtener resultado
$resultado = $stmt -> fetchAll(PDO::FETCH_ASSOC);

    //iterar
foreach($resultado as $propiedad):
    echo $propiedad['titulo'];
    echo "<dr>";
    echo $propiedad['imagen'];
    echo "<dr>";
endforeach;

// echo "<pre>";
// var_dump($resultado);
// echo "</pre>";

?>