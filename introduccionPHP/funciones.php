<?php 
 declare(strict_types=1);//es un tipado que sirve para asegurarte que las funciones tomen el tipo de datos que esperas


//-------------------

//includes: permite incluir otros archivos,se utiliza cuando se quiere incluir templates porque se siguen ejecutando aunque falle el include

 include 'includes/header.php';
 //include ('includes/header.php'); asi tambien se puede usar

//-------------------

//require: permite incluir otros archivos se utiliza cuando se tiene funciones que son crtiticas para la aplicacion, porque se pueden dejar de ejecutar si falla el require
require 'funcion.php';

iniciarApp();

//-------------------

//-------------------

//require_once: permite incluir otros archivos, una sola vez, se utiliza cuando se tiene funciones que son crtiticas para la aplicacion, porque se pueden dejar de ejecutar si falla el require
require_once 'includes/header.php';

//-------------------

//Funciones

 function sumar(){
    echo 2 + 2;
 }

 sumar();

 echo "<br>";

 function sumar2($num1, $num2){//con parametros
    echo $num1 + $num2 ;
 }

 sumar2(3,5);

 echo "<br>";

 function sumar3($num1 = 0, $num2 = 0){//con parametros con default
    echo $num1 + $num2 ;
 }

 sumar3(4);

 echo "<br>";

 function sumar5(int $num1, int $num2){//con parametros con tipado: que tipo de valor tiene que tener el parametro(bool, float, array, string)
    echo $num1 + $num2 ;
 }

 sumar5(10,3);

 echo "<br>";
 
 function sumar6(int $num1, int $num2){//con parametros nombrados
    echo $num1;

    echo "<br>";

    echo $num1 + $num2 ;
 }

 sumar6(num2: 10, num1:3);

 echo "<br>";
 echo "<br>";

//-------------------

function usuarioAutenticado(bool $autenticado) : string{// string,bool,int,array,float: sirve para retornar
    if($autenticado){
        return "El usuario esta autenticado";
    } else {
        return "No autenticado";
    }
}

$usuario = usuarioAutenticado(true);
echo $usuario;

echo "<br>";

function usuarioAutenticado2(bool $autenticado2) : string{// void : sirve para imprimir
    if($autenticado2){
        return "El usuario esta autenticado";
    } else {
        return "No autenticado";
    }
}

$usuario2 = usuarioAutenticado2(false);
echo $usuario2;

echo "<br>";

function usuarioAutenticado3(bool $autenticado3) : ?string{// puede ser que retornemos un string
    if($autenticado3){
        return "El usuario esta autenticado";
    } else {
        return null;
    }
}

$usuario3 = usuarioAutenticado3(false);
echo $usuario3;

echo "<br>";

function usuarioAutenticado4(bool $autenticado4) : string|int{// va aretornar un string o un entero
    if($autenticado4){
        return "El usuario esta autenticado";
    } else {
        return 20;
    }
}

$usuario4 = usuarioAutenticado4(false);
echo $usuario4;

echo "<br>";
echo "<br>";

//-------------------

//JSON

//-- json_encode: sirve para transformar un array en json/string

$productos = [
    [
        'nombre' => 'Tablet',
        'precio' => 200,
        'disponible' => true
    ],
    [
        'nombre' => 'Television',
        'precio' => 300,
        'disponible' => true
    ],
    [
        'nombre' => 'Monitor',
        'precio' => 100,
        'disponible' => false
    ]
];

echo "<pre>";

var_dump($productos);

$json = json_encode($productos);

var_dump($json);

echo "<br>";

//-- json_decode: sirve para transformar un string en array

$json_array = json_decode($json);

var_dump($json_array);
echo "<pre>";

