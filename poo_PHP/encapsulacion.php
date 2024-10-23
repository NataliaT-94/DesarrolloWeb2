<?php 
declare(strict_types = 1);

//Encapsulacion

class Producto{
    // public - Se puede acceder y modificar en cualquier lugar (clase y objeto)
    // protected - Se puede aceder/ modificar unicamente en la clase
    // private - Solo miembros de la misma clase pueden acceder a el

    public function __construct (public string $nombre, public int $precio, public bool $disponible){
    }

    public function mostrarProducto() : void {
        echo "el producto es: " . $this -> nombre . " y su precio es de: " . $this -> precio;
    }
    
}


$producto = new Producto('Tablet', 200, true);
$producto -> mostrarProducto();

//como nombre tiene private no me deja acceder
$producto -> nombre = "Nuevo Nombre";
echo $producto -> nombre;


echo "<pre>";
var_dump($producto);
echo "</pre>";

$producto2 = new Producto('Monitor', 300, true);
$producto2 -> mostrarProducto();

echo "<pre>";
var_dump($producto2);
echo "</pre>";

echo "<br>";
echo "<hr>";


class Productos{


    public function __construct (protected string $nombre, public int $precio, public bool $disponible){
    }

    public function mostrarProducto() : void {
        echo "el producto es: " . $this -> nombre . " y su precio es de: " . $this -> precio;
    }

    //para obtener un valor cuando esta en protected
    public function getNombre() : string{
        return $this -> nombre;
    }
    

    //para modificar un valor cuando esta en protected
    public function setNombre(string $nombre){
        $this -> nombre = $nombre;
    }
    
}



$productos = new Productos('Monitor', 300, true);

echo $productos -> getNombre();
$productos -> setNombre('Nuevo Nombre');

echo "<pre>";
var_dump($productos);
echo "</pre>";





?>