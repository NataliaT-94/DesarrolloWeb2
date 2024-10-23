<?php 
declare(strict_types = 1);

//las clases padres o las que se pueden herdar no se pueden instanciar, por eso se usan las clases abtractas

//clases abstractas, no se pueden instanciar

abstract class Transporte{
    public function __construct(protected int $ruedas, protected int $capacidad){

    }

    public function getInfo() : string{
        return "El transporte tiene " . $this -> ruedas . " ruedas y una capacidad de " . $this -> capacidad . " personas ";
    }
    
}

class Bicicleta extends Transporte{
    public function getInfo() : string{
        return "El transporte tiene " . $this -> ruedas . " ruedas y una capacidad de " . $this -> capacidad . " personas y no gasta gasolina";
    }
}

class Automovil extends Transporte{
    public function __construct(protected int $ruedas, protected int $capacidad, protected string $transmision){

    }

    public function getTransmision() : string{
        return $this -> transmision;
    }
}

$bicicleta = new Bicicleta(2, 1);
echo $bicicleta -> getInfo();

echo "<hr>";

$automovil = new Automovil(4, 4, 'Manual');
echo $automovil -> getInfo();
echo $automovil -> getTransmision();

echo "<hr>";

?>