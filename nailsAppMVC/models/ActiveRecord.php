<?php

namespace Model;
class ActiveRecord{
    //Base de Datos
    protected static $db;
    protected static $tabla = '';
    protected static $columnasDB = [];

    //Alertas y Mensajes
    protected static $alertas = [];

    //Definir la conexion a la BD - includes/database.php
    public static function setDB($database){
        self::$db = $database;
    }

    public static function setAlerta($tipo, $mensaje){
        self::$alertas[$tipo][] = $mensaje;
    }

    //Validacion
    public static function getAlertas() {
        return static::$alertas;
    }

    public function validar() {
        static::$alertas = [];
        return static::$alertas;
    }

    //Consulta SQL para crear un objeto en memoria
    public static function consultarSQL($query){
        //Consultar la bd
        $resultado = self::$db->query($query);

                // Si la consulta falló, logueamos y devolvemos array vacío (evita fatal en fetch_assoc)
        if ($resultado === false) {
            error_log("MySQL error (". self::$db->errno ."): ". self::$db->error ." | Query: ".$query);
            return [];
        }

        //Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()){
            $array[] = static::crearObjeto($registro);
        }

        //Liberar la memoria
        $resultado->free();

        //Retornar los resultados
        return $array;
    }

    //Crear el objeto en memoria que es igual al de la BD
    protected static function crearObjeto($registro){
        $objeto = new static;

        foreach($registro as $key => $value){
            if(property_exists($objeto, $key)){
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    //Identificar y unir los atributos de la BD
    public function atributos(){
        $atributos = [];
        foreach(static::$columnasDB as $columna){
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

public function sanitizarAtributos(): array {
    $atributos = $this->atributos();
    $sanitizado = [];

    foreach ($atributos as $key => $value) {
        if ($value === null) {
            // mantenemos null para luego generar NULL en SQL
            $sanitizado[$key] = null;
        } else {
            // escapamos como string (incluye números/booleans casteados)
            $sanitizado[$key] = self::$db->real_escape_string((string)$value);
        }
    }
    return $sanitizado;
}

// Sincroniza datos del formulario con las propiedades del modelo
public function sincronizar($args = []){
    foreach($args as $key => $value){
        if(property_exists($this, $key)){
            // si viene cadena vacía podés dejarla como null
            $this->$key = ($value === '') ? null : $value;
        }
    }
}


    //Registros - CRUD
    public function guardar(){
        $resultado = '';
        if(!is_null($this->id)){
            //actualizzar
            $resultado = $this->actualizar();
        } else {
            //Creando un nuevo registro
            $resultado = $this->crear();
        }
        return $resultado;
    }

    
    //Lista Todos los registros
    public static function all(){
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    //Buscar un registro por su id
    public static function find($id){
        $query = "SELECT * FROM " . static::$tabla ." WHERE id = {$id}";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    //Obtener Registro con cierta cantidad
    public static function get($limite){
        $query = "SELECT * FROM " . static::$tabla ." LIMIT {$limite}";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    //Buscar un registro por su columna y valor
    public static function where($columna, $valor){
        $query = "SELECT * FROM " . static::$tabla . " WHERE {$columna} = '{$valor}'";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    //Consulta PLANA de SQL (Utilizar cuando los metodos del modelo no son suficientes)
    public static function SQL($query){
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    //Crear un nuevo registro
public function crear(){
    $atributos = $this->sanitizarAtributos();

    $columnas = join(', ', array_keys($atributos));
    $valores  = join(', ', array_map(
        fn($v) => $v === null ? 'NULL' : "'$v'",
        array_values($atributos)
    ));

    $query = "INSERT INTO " . static::$tabla . " ( $columnas ) VALUES ( $valores )";

    $resultado = self::$db->query($query);
    return [
        'resultado' => $resultado,
        'id' => self::$db->insert_id
    ];
}

    //Actualizar el registro
public function actualizar(){
    $atributos = $this->sanitizarAtributos();

    $valores = [];
    foreach($atributos as $key => $value){
        $valores[] = ($value === null) ? "{$key}=NULL" : "{$key}='{$value}'";
    }

    $id = self::$db->real_escape_string((string)$this->id);
    $query = "UPDATE " . static::$tabla . " SET " . join(', ', $valores) .
             " WHERE id = '$id' LIMIT 1";

    return self::$db->query($query);
}

    //Eliminar un Registro por su ID
    public function eliminar(){
        $query = "DELETE FROM " . static::$tabla . " WHERE id = ". 
        self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);
        return $resultado;
    }

    

}

?>