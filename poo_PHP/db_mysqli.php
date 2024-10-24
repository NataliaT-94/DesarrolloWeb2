<?php

//Conectar a la BD con Mysqli

$db = new mysqli('localhost', 'root', '', 'bienesraices_crud');

$query = "SELECT titulo FROM propiedades";
$resultado = $db -> query($query);


//multiples resultados
while($row = $resultado -> fetch_assoc()):
    var_dump($row);
endwhile;

//solo un resultado
//var_dump($resultado -> fetch_assoc());


?>
