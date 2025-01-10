<?php
namespace Model;

class Cita extends ActiveRecord{
    //Base de Datos
    protected static $tabla = 'citas';//la informacion la va a sacer de la tabla de usuarios
    protected static $columnasDB = ['id', 'fecha', 'hora', 'usuarioId'];
    
    public $id;
    public $fecha;
    public $hora;
    public $usuarioId;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->fecha = $args['fecha'] ?? '';
        $this->hora = $args['hora'] ?? '';
        $this->usuarioId = $args['usuarioId'] ?? '';
        
    }
}



?>