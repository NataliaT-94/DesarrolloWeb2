<?php

namespace App;

class Propiedad{

    //BASE DE DATOS
    protected static $db;
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 
                                    'habitaciones', 'banio', 'estacionamiento', 'creado', 'vendedorId'];

    //Errores
    protected static  $errores = [];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $banio;
    public $estacionamiento;
    public $creado;
    public $vendedorId;

    //Definir la conexion a la BD
    public static function setDB($database){
        self::$db = $database;
    }

    public function __construct($args = [])
    {
        $this -> id = $args['id'] ?? '';
        $this -> titulo = $args['titulo'] ?? '';
        $this -> precio = $args['precio'] ?? '';
        $this -> imagen = $args['imagen'] ?? '';
        $this -> descripcion = $args['descripcion'] ?? '';
        $this -> habitaciones = $args['habitaciones'] ?? '';
        $this -> banio = $args['banio'] ?? '';
        $this -> estacionamiento = $args['estacionamiento'] ?? '';
        $this -> creado = date('Y/m/d');
        $this -> vendedorId = $args['vendedorId'] ?? '';
    }

    public function guardar() {

        //Sanitizar los datos
        $atributos = $this -> sanitizarAtributos();

        //array_keys: te permite acceder a las llaves de un array
        //array_values : te permite acceder al valor de un array
        //join: transforma un array en un string


        // insertar base de datos
        // $query = 'INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, banio, estacionamiento, creado, vendedorId) 
        //           VALUES ("' . $this->titulo . '", "' . $this->precio . '", "' . $this->imagen . '", "' . $this->descripcion . '", "' . $this->habitaciones . '", 
        //           "' . $this->banio . '", "' . $this->estacionamiento . '", "' . $this->creado . '", "' . $this->vendedorId . '")';
        
        $query = " INSERT INTO propiedades ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";

        // debuguear($query);

        $resultado = self::$db -> query($query);

    }
    
    //Identificar y unir los atributos de la BD
    public function atributos(){
        $atributos = [];

        foreach(self::$columnasDB as $columna){

            if($columna === 'id') continue;//ignora al id

            $atributos[$columna] = $this -> $columna;
        }
        return $atributos;
    }


    public function sanitizarAtributos(){
        $atributos = $this -> atributos();
        $sanitizado = [];

        foreach($atributos as $key => $value){
            $sanitizado[$key] = self::$db -> escape_string($value);
        }
        
        return $sanitizado;
    }

    //Subida de archivos
    public function setImagen($imagen){
        //Asignar al atributo imagen el nombre de la imagen
        if($imagen){
            $this -> imagen = $imagen;
        }
    }

    //Validacion
    public static function getErrores(){
        return self::$errores;
    }

    public function validar(){
        if(!$this -> titulo){//si no hay titulo
            self::$errores[] = "Debes añadir un titulo";
        }

        if(!$this -> precio){
            self::$errores[] = "Debes añadir un precio";
        }

        if(strlen($this -> descripcion) < 50){
            self::$errores[] = "La descripcion es oblidgatoria y debe tener al menos 50 caracteres";
        }

        if(!$this -> habitaciones){
            self::$errores[] = "El numero de habitaciones es obligatorio";
        }

        if(!$this -> banio){
            self::$errores[] = "El numero de banios es obligatorio";
        }

        if(!$this -> estacionamiento){
            self::$errores[] = "El numero de estacionamientos es obligatorio";
        }

        if(!$this -> vendedorId){
            self::$errores[] = "Elije un vendedor";
        }

        // if(!$this -> imagen['name'] || $this -> imagen['error']){
        //         self::$errores[] = "La imagen es obligatoria";
        // }

        // //Validar por tamaño (1mb maximo)
        // $medida = 1000 * 1000;

        // if($this -> imagen['size'] > $medida){
        //         self::$errores[] = "La imagen es muuy pesada";
        // }
        return self::$errores;
    }

}


?>