<?php

namespace Model;

class Propiedad extends ActiveRecord{

    protected static $tabla = 'propiedades';
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 
                                    'habitaciones', 'banio', 'estacionamiento', 'creado', 'vendedorId'];

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

    public function __construct($args = [])
    {
        $this -> id = $args['id'] ?? NULL ;
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

        if(!$this -> imagen){
                self::$errores[] = "La imagen es obligatoria";
        }
        
        return self::$errores;
    }


}


?>