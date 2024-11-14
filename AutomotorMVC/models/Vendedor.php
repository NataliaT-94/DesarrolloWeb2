<?php

namespace Model;

class Vendedor extends ActiveRecord{

    protected static $tabla = 'vendedores';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono'];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    public function __construct($args = [])
    {
        $this -> id = $args['id'] ?? NULL ;
        $this -> nombre = $args['nombre'] ?? '';
        $this -> apellido = $args['apellido'] ?? '';
        $this -> telefono = $args['telefono'] ?? '';

    }

    public function validar(){
        if(!$this -> nombre){//si no hay titulo
            self::$errores[] = "El Nombre es obligatorio";
        }
        if(!$this -> apellido){//si no hay titulo
            self::$errores[] = "El Apellido es obligatorio";
        }
        if(!$this -> telefono){//si no hay titulo
            self::$errores[] = "El Telefono es obligatorio";
        }
        //exprecion regular
        if(!preg_match('/[0-9]{10}/', $this -> telefono)){//es una extencion fija de 1o numeros, que acepta numeros del 0 al 9
            self::$errores[] = "Formato no valido";
        }

        return self::$errores;
    }
}


?>