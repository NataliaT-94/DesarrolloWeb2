<?php

namespace Model;

class Vehiculo extends ActiveRecord{
    protected static $tabla = 'vehiculos';
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'modelo', 'puertas', 'motor', 'creado', 'vendedorId'];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $modelo;
    public $puertas;
    public $motor;
    public $creado;
    public $vendedorId;

    public function __construct($args = [])
    {
        $this -> id = $args['id'] ?? NULL ;
        $this -> titulo = $args['titulo'] ?? '';
        $this -> precio = $args['precio'] ?? '';
        $this -> imagen = $args['imagen'] ?? '';
        $this -> descripcion = $args['descripcion'] ?? '';
        $this -> modelo = $args['modelo'] ?? '';
        $this -> puertas = $args['puertas'] ?? '';
        $this -> motor = $args['motor'] ?? '';
        $this -> creado = date('Y/m/d');
        $this -> vendedorId = $args['vendedorId'] ?? '';
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
        if(!$this -> modelo){
            self::$errores[] = "Debes añadir un modelo";
        }
        if(!$this -> puertas){
            self::$errores[] = "Debes añadir cantidad de puertas";
        }
        if(!$this -> motor){
            self::$errores[] = "Debes añadir un modelo de motor";
        }
        if(!$this -> vendedorId){
            self::$errores[] = "Elije un vendedor";
        }

        // if(!$this -> imagen){
        //         self::$errores[] = "La imagen es obligatoria";
        // }
        
        if(!$this->id )  {
            $this->validarImagen();
        }
        return self::$errores;
    }

    public function validarImagen() {
        if(!$this->imagen ) {
            self::$errores[] = 'La Imagen es Obligatoria';
        }
    }

        
       
}

?>