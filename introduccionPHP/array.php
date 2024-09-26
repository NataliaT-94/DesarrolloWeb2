<?php 
include 'includes/header.php'; //permite incluir otros archivos


// Arrays Indexados

$carrito = ['Tablet', 'Television', 'Computadora'];

//--Util para ver los contenidos del array
echo"<pre>";//ayuda a visualizar mejor el var_dum
var_dump($carrito);
echo"<pre>";

echo "<br>";

echo"<pre>";
var_dump($carrito[1]);
echo"<pre>";

echo "<br>";
echo "<br>";

//--Acceser a los elementos del array
echo $carrito[1];

echo "<br>";
echo "<br>";

//--Añade un elemento en el indice 3 del array
$carrito[3] = 'Nuevo Producto...';
echo"<pre>";
var_dump($carrito);
echo"<pre>";

echo "<br>";
echo "<br>";

//--Añade un elemento nuevo al final
array_push($carrito, 'Auriculares');
echo"<pre>";
var_dump($carrito);
echo"<pre>";

echo "<br>";
echo "<br>";

//--Añade un elemento nuevo al inicio
array_unshift($carrito, 'Smartwatch');
echo"<pre>";
var_dump($carrito);
echo"<pre>";

echo "<br>";
echo "<br>";

//--Diferente sintaxis, los dos funcionan de la misma forma
$clientes = array('Cliente1', 'Cliente2', 'Cliente3');
echo"<pre>";
var_dump($clientes);
echo"<pre>";

echo "<br>";

echo $clientes[1];

echo "<br>";
echo "<br>";

// ----------------------

// Arrays Asociativos: accedes a ellos por medio de un a propiedad

$cliente = [
    'nombre' => 'Natt',
    'saldo' => 200,
    'informacion' =>[
        'tipo' => 'premium',
        'disponible' => 100
    ]
];

echo"<pre>";
var_dump($cliente);
echo"<pre>";

echo "<br>";
echo "<br>";

echo $cliente['nombre'];

echo "<br>";

echo $cliente['informacion']['tipo'];

echo "<br>";
echo "<br>";

$cliente['codigo'] = 123456; // lo agrega automaticamente al array
echo"<pre>";
var_dump($cliente);
echo"<pre>";

echo "<br>";

$cliente['nombre'] = 'Techeira'; // lo cambia automaticamente
echo"<pre>";
var_dump($cliente);
echo"<pre>";

echo "<br>";
echo "<br>";

// ----------------------

// 

$clientes = [];
$clientes2 = array();
$clientes3 = array('Natalia', 'Evelyn', 'Braian');
$clientes5 = [
    'nombre' => 'Natt',
    'saldo' => 200
];

// Empty: sirve para ver si un array esta vacio o no

var_dump(empty($clientes));
var_dump(empty($clientes2));
var_dump(empty($clientes3));

echo "<br>";
echo "<br>";

// Isset: Revisa si un arreglo esta creado o una propiedad esta definida

var_dump(isset($clientes4));
var_dump(isset($clientes));
var_dump(isset($clientes2));
var_dump(isset($clientes3));

echo "<br>";
echo "<br>";

// Isset: Tambien Permite revisar si una propiedad de un array asociativa, existe.

var_dump(isset($clientes5['nombre']));
var_dump(isset($clientes5['codigo']));

echo "<br>";
echo "<br>";

// ----------------------

// in_array - buscar un elemento en un array

$carrito = ['Tablet', 'Television', 'Computadora'];

var_dump(in_array('Tablet', $carrito));
var_dump(in_array('Auriculares', $carrito));

echo "<br>";
echo "<br>";

// Ordenar elemento de un array

$numero = array(1,2,4,3,5,1);

sort($numero); // de menor a mayor
echo "<pre>";
var_dump($numero);
echo "<pre>";

rsort($numero); // de mayor a menor

echo "<pre>";
var_dump($numero);
echo "<pre>";

echo "<br>";
echo "<br>";

// Ordenar array asociativo

$cliente = [
    'saldo' => 200,
    'tipo' => 'Premium',
    'nombre' => 'Natt'
];

//--asort: Ordena por valores(orden alfabetico A-Z)

asort($cliente);

echo "<pre>";
var_dump($cliente);
echo "<pre>";

//--arsort: Ordena por valores(orden alfabetico Z-A)

asort($cliente);

echo "<pre>";
var_dump($cliente);
echo "<pre>";

//--ksort: Ordena por llaves(orden alfabetico A-Z)

ksort($cliente);

echo "<pre>";
var_dump($cliente);
echo "<pre>";

//--krsort: Ordena por llaves(orden alfabetico de Z-A)

krsort($cliente);

echo "<pre>";
var_dump($cliente);
echo "<pre>";

echo "<br>";
echo "<br>";
