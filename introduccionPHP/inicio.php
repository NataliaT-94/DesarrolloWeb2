<?php 
include 'includes/header.php'; //permite incluir otros archivos

echo "HOla Mundo";//imprime lo que tien al lado

echo "<br>";

print "Hola Mundo";//imprime lo que tien al lado

echo "<br>";

var_dump("Hola mundo"); //Nos da mas informacion sobre un texto o un a variable q estamos imprimiendo 

echo "<br>";

// ----------------------

// Variables 

$nombre = "NAtt"; // esta se pueden reasignar
echo $nombre;

echo "<br>";

define('constante', "Este es el valor de la constante");//No se pueden reasignar, el primer parametro es el nombre de la constante y el segundo es el  valor de la constante
echo constante;

echo "<br>";

const constante2 = "Hola 2";//no se usa mucho
echo constante2;

echo "<br>";
echo "<br>";

$nombreCliente = "Braian";
$nombre_cliente = "Braian";


// ----------------------

// Tipos de Datos

//--Booolean
$logueado = true;
var_dump($logueado);

echo "<br>";

//--Enteros
$numero = 200;
var_dump($numero);

echo "<br>";

//--Float
$float = 200.5;
var_dump($float);

echo "<br>";

//--String
$nombre = "Braian";
var_dump($nombre);

echo "<br>";

$array = [];
var_dump($array);

echo "<br>";
echo "<br>";
// ----------------------

// Operadores

$num1 = 20;
$num2 = 10;

//--Sumar
echo $num1 + $num2;

echo "<br>";

//--Restar
echo $num1 - $num2;

echo "<br>";

//--Multiplicar
echo $num1 * $num2;

echo "<br>";

//--Dividir
echo $num1 / $num2;

echo "<br>";

//--Multiplicar cierta cantidad de veces
echo 2 ** 3;

echo "<br>";
echo "<br>";

// ----------------------

// Comparadores

$num1 = 20;
$num2 = 30;
$num3 = 30;
$num4 = "30";

var_dump($num1 < $num2);

echo "<br>";

var_dump($num1 <= $num2);

echo "<br>";

var_dump($num1 >= $num2);

echo "<br>";

var_dump($num2 == $num3);

echo "<br>";

var_dump($num2 == $num4);

echo "<br>";

var_dump($num1 <=> $num2);//< = > si el primer numero es mas chicoque el segundo nos da un -1

echo "<br>";

var_dump($num2 <=> $num3);//< = > si el primer numero es igual que el segundo nos da un 0

echo "<br>";

var_dump($num2 <=> $num1);//< = > si el primer numero es mas grnde que el segundo nos da un 1

echo "<br>";
echo "<br>";

// ----------------------

// Incrementos y deccremento

$numero1 = 30;
$numero1 ++;
echo $numero1;
echo "<br>";
echo ++$numero1;

echo "<br>";
$numero1 += 5;
echo $numero1;

echo "<br>";
echo "<br>";

$numero2 = 30;
$numero2 --;
echo $numero2;

echo "<br>";
echo --$numero2;

echo "<br>";
echo "<br>";

// ----------------------

// Funciones para Strings

$nombreCliente = "Natt Techeira";

//--Conocer la extencion de un String
echo strlen($nombreCliente);

echo "<br>";
echo "<br>";

var_dump($nombreCliente);

echo "<br>";
echo "<br>";

//--Eliminar espacios en blanco
$nombreCliente2 = "    Natt Techeira    ";

$texto = trim($nombreCliente2);//elimina los espacion en blanco del inicio y el fin
echo strlen($texto);

echo "<br>";
echo "<br>";

//--Convertirlo a Mayusculas
echo strtoupper($nombreCliente);

echo "<br>";
echo "<br>";

//--Convertirlo a Minusculas
echo strtolower($nombreCliente);

echo "<br>";
echo "<br>";

$mail1 = "correo@correo.com";
$mail2 = "Correo@correo.com";

var_dump(strtolower($mail1) == strtolower($mail2));

echo "<br>";
echo "<br>";

//--Reemplazar texto
echo str_replace('Natt', 'N', $nombreCliente);

echo "<br>";
echo "<br>";

//--Revisar si un string existe o no
echo strpos($nombreCliente, 'Natt');//nos indica en posicion se encuentra

echo "<br>";
echo "<br>";

//--Concatenar texto
$tipoCliente = "Premium";

echo "El cliente " . $nombreCliente . " es " . $tipoCliente;//se concatena con un '.'

