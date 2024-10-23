<?php 
declare(strict_types = 1);

//interface: nos dice que hace una clase y que funciones tiene y que datos retorna, pero no nos dice como lo hace
interface TransporteInterfaz{
    public function getInfo() : string;
    public function getRuedas() : int;
}



class Transporte implements TransporteInterfaz {
    public function __construct(protected int $ruedas, protected int $capacidad){

    }

    public function getInfo() : string{
        return "El transporte tiene " . $this -> ruedas . " ruedas y una capacidad de " . $this -> capacidad . " personas ";
    }

    public function getRuedas() : int {
        return $this -> ruedas;
    }
    
}

//polimorfismo

class Automovil extends Transporte implements TransporteInterfaz{
    public function __construct(protected int $ruedas, protected int $capacidad, protected string $color){

    }
    public function getInfo() : string{
        return "El transporte Auto tiene " . $this -> ruedas . " ruedas y una capacidad de " . $this -> capacidad . " personas y tiene el color " . $this -> color;
    }
}

echo "<pre>";
var_dump($transporte = new Transporte(8, 20));
var_dump($auto = new Automovil(4, 4, 'Rojo'));

echo $transporte -> getInfo();
echo "<hr>";
echo $auto -> getInfo();
echo "</pre>";


?>