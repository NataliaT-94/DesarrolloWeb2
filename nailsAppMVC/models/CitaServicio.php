<?php
namespace Model;

class CitaServicio extends ActiveRecord{
    //Base de Datos
    protected static $tabla = 'citasservicios';//la informacion la va a sacer de la tabla de usuarios
    protected static $columnasDB = ['id', 'citaId', 'servicioId'];
    
    public $id;
    public $citaId;
    public $servicioId;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->citaId = $args['citaId'] ?? '';
        $this->servicioId = $args['servicioId'] ?? '';
 
    }
}

?>