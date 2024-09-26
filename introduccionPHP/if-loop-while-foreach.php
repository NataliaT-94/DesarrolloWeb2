<?php 
include 'includes/header.php'; //permite incluir otros archivos

// if 

$autenticado = true;
$admin = false;

if ($autenticado) {
    echo "Ususario autenticado correctamente";
} else {
    echo "Ususario no autenticado, inicia sesion";
}

echo "<br>";

if ($autenticado || $admin) {
    echo "Ususario autenticado correctamente";
} else {
    echo "Ususario no autenticado, inicia sesion";
}

echo "<br>";

if ($autenticado && $admin) {
    echo "Ususario autenticado correctamente";
} else {
    echo "Ususario no autenticado, inicia sesion";
}

echo "<br>";
echo "<br>";


// if anidados...

$cliente =[
    'nombre' => 'Juan',
    'saldo' => 200,
    'informacion' => [
        'tipo' => 'Premium'
    ]
];

if(!empty($cliente)){// -- !: se niega, !empty: no esta vacio
    echo "El Array del cliente no esta vacio.";

    if($cliente['saldo'] > 0){
        echo "El cliente tiene saldo disponible";
    } else {
        echo "No hay saldo";
    }
}

echo "<br>";

//else if

if($cliente['saldo'] > 0){
    echo "El cliente tiene saldo disponible";
} else if($cliente['informacion']['tipo'] === 'Premium'){
    echo "El cliente es Premium";
}else {
    echo "No hay saldo o no es premium";
}

echo "<br>";
echo "<br>";

// Switch

$tecnologia = 'PHP';

switch ($tecnologia){
    case 'PHP':
        echo "PHP, un excelente lenguaje";
        break;
    case 'JavaScript':
        echo "un excelente lenguaje web";
        break;
    case 'HTML':
        echo "bueno";
        break;
    default:
        echo "Algun leguaje cualquiera";
        break;
}

echo "<br>";
echo "<br>";

// ----------------------

// loop: nos permiten ejecutar sierto codigo determinada cantidad de veces sin tener que escribir todo el tiempo

//-- While: Se va a ejecutar hasta que un condicion sea evaluada como falsa

$i = 0; //inicializador

while($i < 10){
    echo $i . "<br>";
    $i++; //incremento
}

echo "<br>";
echo "<br>";

//-- Do While: Se va a ejecutar hasta que un condicion sea evaluada como falsa, pero primero ejecuta el codigo y luego lo evalua

$i = 0; 

do{
    echo $i . "<br>";
   
    $i++; 
} while($i < 10);

echo "<br>";
echo "<br>";

//-- for loop: Se va a ejecutar hasta que un condicion sea evaluada como falsa.

for($i = 0; $i < 10; $i++){
    echo $i . "<br>";

}

echo "<br>";
echo "<br>";

/**
 * si es multiplo de 3 imprimir Fizz 
 * si es multiplo de 5 imprimir Buzz 
 * si es multiplo de 3 y 5 imprimir Fizz Buzz 
 */

 for($i = 1; $i < 100; $i++){
    if($i % 3 === 0 && $i % 5 === 0){//si i es multiplo de 3 y de 5
        echo $i . "-Fizz Buzz <br>";
    
    }else if($i % 3 === 0){//si i es multiplo de 3
        echo $i . "-Fizz <br>";

    }else if($i % 5 === 0){//si i es multiplo de 5
        echo $i . "-Buzz <br>";

    }
}

echo "<br>";
echo "<br>";

//-- forEach: sirve para recorrer arrays

$clientes = array('Natt', 'Evelyn', 'Braian');

foreach($clientes as $cliente){// creamos un alias llamado $cliente
    echo $cliente . '<br>';
}

/** es lo mismo que escribir esto
 * for($i = 0; $i < coutn($clientes); $i++){
    *  echo $clientes[$i] . '<br>';
*}
 */

echo "<br>";
echo "<br>";

$cliente = [
    //llave => valor
    'nombre' => 'Natt',
    'saldo' => 300,
    'tipo' => 'Premium'
];

foreach($cliente as $valor){
    echo $valor . '<br>';
}

echo "<br>";

foreach($cliente as $key => $valor){//para visualizar las llaves y su valor
    echo $key. " - ". $valor . '<br>';
}

echo "<br>";
echo "<br>";


//-- Ejemplo de ForEach

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

foreach($productos as $producto){ ?>
    <li>
        <p>
            Producto: <?php echo $producto['nombre']; ?>
        </p>
        <p>
            Precio: <?php echo "$ ". $producto['precio']; ?>
        </p>
        <p>
           <?php echo ($producto['disponible']) ? 'Disponible' : 'No Disponible' ?> <!--Operador Ternario-->
        </p>
        <?php 
            // if($producto['disponible']){
            //     echo "<p>Disponible</p>";
            // } else {
            //     echo "<p>No Disponible</p>";
            // }
        ?>
    </li>
    <?php
}

include 'includes/footer.php';