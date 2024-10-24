<?php

//Conectar a la BD con Mysqli

$db = new mysqli('localhost', 'root', '', 'bienesraices_crud'); //nos conectamos a la bd

// $query = "SELECT titulo FROM propiedades";
// $resultado = $db -> query($query);


//multiples resultados
// while($row = $resultado -> fetch_assoc()):
//     var_dump($row);
// endwhile;

//solo un resultado
//var_dump($resultado -> fetch_assoc());




//SENTENCIA PREPARADA.. son mas seguras y te impiden tener problemas de inyeccion de codigo sql, y en caso de tener que volver a realizar la misma consulta se almacena en memoria y no vuelve el servidor hacer todo el trabajo

    //Creamos la query
$query = "SELECT titulo, imagen FROM propiedades";

    //Lo preparamos
$stmt = $db -> prepare($query);

    //Lo ejecutamos
$stmt -> execute();

    //Creamos la variable
$stmt -> bind_result($titulo, $imagen);//asigna la informacion a la variable que creaste con los resultados de la consulta, en este caso del titulo

    //Asignamos el resultado
$stmt -> fetch();

    //Imprimir un resultado
var_dump($titulo);
var_dump($imagen);

    //imprimir multiples resultados
while($stmt -> fetch()):
    var_dump($titulo);
endwhile;



?>
