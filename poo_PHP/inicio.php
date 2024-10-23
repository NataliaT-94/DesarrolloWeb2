<?php 
declare(strict_types = 1);

//Definir una Clase
class Producto{
    //  public $nombre;
    //  public $precio;
    //  public $disponible;

    // //constructor.... solo funciona en php7 o menos
    // public function __construct (string $nombre, int $precio, bool $disponible)
    // {
    //      $this -> nombre = $nombre;
    //      $this -> precio = $precio;
    //      $this -> disponible = $disponible;
    // }

    //constructor.... solo funciona en php8
    public function __construct (public string $nombre, public int $precio, public bool $disponible){
    }

    //Metodos

    public function mostrarProducto(){
        echo "el producto es: " . $this -> nombre . " y su precio es de: " . $this -> precio;
    }
    
}

//instanciando la clase
$producto = new Producto('Tablet', 200, true);


$producto -> mostrarProducto();

//agregando informacion
// $producto -> nombre = 'Tablet';
// $producto -> precio = 200;
// $producto -> disponible = true;

echo "<pre>";
var_dump($producto);
echo "</pre>";

echo "<br>";
echo "<hr>";

class Productos{

    public function __construct (public string $nombre, public int $precio, public bool $disponible){
    }

    //Metodos Estaticos

    public static function obtenerProducto(){
        echo "Obteniendo datos del producto...";
    }

}

echo Productos::obtenerProducto();


echo "<br>";
echo "<hr>";



class Productoss{
    
    public $imagen;
    //Atributos estaticos
    public static $imagenPlaceholder = "imagen.jpg";

    public function __construct (public string $nombre, public int $precio, public bool $disponible, string $imagen){

        if($imagen){
            self::$imagenPlaceholder = $imagen;
        }
    }

    public static function obtenerImagenProducto(){
        return self::$imagenPlaceholder;
    }

    public function mostrarProducto(){
        echo "el producto es: " . $this -> nombre . " y su precio es de: " . $this -> precio;
    }

}

//no tiene imagen por eso carga el imagenPlaceholder
$productoss = new Productoss('Tablet', 200, true, '');

echo $productoss -> obtenerImagenProducto();


$productoss -> mostrarProducto();

echo "<pre>";
var_dump($productoss);
echo "</pre>";

//si tiene imagen por eso carga la imagen
$productoss2 = new Productoss('Monitor', 200, true, 'monitorCurvo.jpg');

echo $productoss2 -> obtenerImagenProducto();


$productoss2 -> mostrarProducto();

echo "<pre>";
var_dump($productoss2);
echo "</pre>";




?>