<?php
namespace Model;

class ActiveRecord{
    
    //BASE DE DATOS
    protected static $db;
    protected static $tabla = '';
    protected static $columnasDB = [];


    //Errores
    protected static  $errores = [];


    //Definir la conexion a la BD
    public static function setDB($database){
        self::$db = $database;
    }

    //Validacion
    public static function getErrores(){

        return static::$errores;
    }

    public function validar(){

        static::$errores = [];
        return static::$errores;
    }

    // Registros - CRUD
    public function guardar(){
        $resultado = '';
        if(!is_null($this->id)){//no tiene que eswtar en null para actualizar
            //Actualiza
            $resultado = $this->actualizar();
        
        } else {//si esta en null crea
            //Creando un nuevo registro
            $resultado = $this->crear();
        }
        return $resultado;
    }

    //Lista todos los registros
    public static function all(){
        $query = "SELECT * FROM " . static::$tabla;//hereda el metodo y busca el atibuto en la clase que se esta heredando
        // debuguear($query);

        $resultado = self::consultarSQL($query);

        return $resultado;
    }



    //Busca un registro por su id
    public static function find($id){
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = ${id}";

        $resultado = self::consultarSQL($query);

        return array_shift($resultado);//retorna la primera posicion

    }

    //Obtiene determinado numero de registros
    public static function get($cantidad){
        $query = "SELECT * FROM " . static::$tabla . " LIMIT  ${cantidad}";//static:hereda el metodo y busca el atibuto en la clase que se esta heredando
        //  debuguear($query);
    
        $resultado = self::consultarSQL($query);
    
        return $resultado;
    }
    
    public function crear() {

        //Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        //array_keys: te permite acceder a las llaves de un array
        //array_values : te permite acceder al valor de un array
        //join: transforma un array en un string


        // insertar base de datos
        // $query = 'INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, banio, estacionamiento, creado, vendedorId) 
        //           VALUES ("' . $this->titulo . '", "' . $this->precio . '", "' . $this->imagen . '", "' . $this->descripcion . '", "' . $this->habitaciones . '", 
        //           "' . $this->banio . '", "' . $this->estacionamiento . '", "' . $this->creado . '", "' . $this->vendedorId . '")';
        
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES ('";
        $query .= join("', '", array_values($atributos));
        $query .= "') ";

        // debuguear($query);

        $resultado = self::$db->query($query);

        return $resultado;
    }

    public function actualizar(){
        //Sanitizar los datos
        $atributos = $this -> sanitizarAtributos();

        $valores = [];
        foreach($atributos as $key => $value){
            $valores[] = "{$key}='{$value}'";
        }

        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1";

        $resultado = self::$db->query($query);

        return $resultado;
        
    }

    //Eliminar un registro
    public function eliminar(){
        //Elimminar el registro
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
    
        $resultado = self::$db->query($query);
        
        if($resultado){
            $this -> borrarImagen();
        }
        return $resultado;
    }

    public static function consultarSQL($query){
        //Consultar la base de datos
        $resultado = self::$db->query($query);

        //Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()){
            $array[] = static::crearObjeto($registro);
        }

        // debuguear($array);

        //Liberar la memoria
        $resultado -> free();


        //Retornar los resultados
        return $array;
    }

    protected static function crearObjeto($registro){//transforma el array en objeto
        $objeto = new static;

        foreach($registro as $key => $value){
            if(property_exists($objeto, $key)){//property_exists: verifica que la propiedad exista
                $objeto->$key = $value;//una vez que verifique que exista el objeto le asigna el valor
            }
        }
                    
        return $objeto;
    }

    //Identificar y unir los atributos de la BD
    public function atributos(){
        $atributos = [];

        foreach(static::$columnasDB as $columna){

            if($columna === 'id') continue;//ignora al id

            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }
    
    public function sanitizarAtributos(){
        $atributos = $this->atributos();
        $sanitizado = [];
    
        foreach($atributos as $key => $value){
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        
        return $sanitizado;
    }
    

    //Sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar( $args = []){
        foreach($args as $key => $value){
            if(property_exists($this, $key) && !is_null($value)){//this hace referencia al obejto actual
                $this->$key = $value;
            }
        }
    }

    
    //Subida de archivos
    public function setImagen($imagen){
        //Elimina la imagen previa
        if(!is_null($this->id)){
            $this->borrarImagen();
        }
        //Asignar al atributo imagen el nombre de la imagen
        if($imagen){
            $this->imagen = $imagen;
        }
    }

    //Eliminar el archivo
    public function borrarImagen(){
        //Comprobar si existe el archivo
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if($existeArchivo){
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
        
    }
}

?>