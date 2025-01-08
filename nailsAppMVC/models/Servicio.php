<?php
namespace Model;

class Servicio extends ActiveRecord{
        //Base de Datos
        protected static $tabla = 'servicios';//la informacion la va a sacer de la tabla de usuarios
        protected static $columnasDB = ['id', 'nombre', 'precio'];
    
        public $id;
        public $nombre;
        public $precio;

        public function __construct($args = []){
            $this->id = $args['id'] ?? null;
            $this->nombre = $args['nombre'] ?? '';
            $this->precio = $args['precio'] ?? '';
         
        
        }
        
   
    
}



?>