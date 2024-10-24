<?php
//si tenes dos clases con el mim¿smo nombre se recomienda usar los namespaces

// require 'clases/clientes.php';
// require 'clases/detalles.php';

use App\Clientes;
use App\Detalles;

function mi_autoload($clase) {
    $partes = explode('\\', $clase);//busca la '\' en $clase
    require __DIR__ . '/clases/' . $partes[1] . '.php';
}

//var_dump($partes);

spl_autoload_register('mi_autoload');

// class Clientes{
//     public function __construct()
//     {
//         echo "Desde namespaces.php que contiene los clientes";
//     }
// }

//incluir con require
// $detalles = new App\Detalles();
// $clientes = new App\Clientes();
// $clientes2 = new Clientes();

$clientes = new Clientes();
$detalles = new Detalles();

?>