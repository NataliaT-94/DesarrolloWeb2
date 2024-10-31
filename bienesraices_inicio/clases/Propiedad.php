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
        $this -> id = $args['id'] ?? NULL ;
        $this -> titulo = $args['titulo'] ?? '';
        $this -> precio = $args['precio'] ?? '';
        $this -> imagen = $args['imagen'] ?? '';
        $this -> descripcion = $args['descripcion'] ?? '';
        $this -> habitaciones = $args['habitaciones'] ?? '';
        $this -> banio = $args['banio'] ?? '';
        $this -> estacionamiento = $args['estacionamiento'] ?? '';
        $this -> creado = date('Y/m/d');
        $this -> vendedorId = $args['vendedorId'] ?? 1;
    }

    public function guardar(){
        if(!is_null($this -> id)){
            //Actualiza
            $this -> actualizar();

        } else {
            //Creando un nuevo registro
            $this -> crear();
        }
    }

    public function crear() {

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

        return $resultado;

    }

    public function actualizar(){
        //Sanitizar los datos
        $atributos = $this -> sanitizarAtributos();

        $valores = [];
        foreach($atributos as $key => $value){
            $valores[] = "{$key}='{$value}'";
        }

        $query = "UPDATE propiedades SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$db -> escape_string($this -> id) . "' ";
        $query .= " LIMIT 1 ";

        $resultado = self::$db -> query($query);

        if($resultado){
            //Redireccionar al usuario
            header('Location: http://localhost/GitHub/DesarrolloWeb2/bienesraices_inicio/admin?mensaje=2');

        }
    }

    //Eliminar un registro
    public function eliminar(){
        //Elimminar la propiedad
        $query = "DELETE FROM propiedades WHERE id = " . self::$db -> escape_string($this -> id) . " LIMIT 1";
    
        $resultado = self::$db -> query($query);
        
        if($resultado){
            $this -> borrarImagen();
            header('Location: http://localhost/GitHub/DesarrolloWeb2/bienesraices_inicio/admin?mensaje=3');
        }
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
        //Elimina la imagen previa
        if(isset($this -> id)){
            $this -> borrarImagen();
        }
        //Asignar al atributo imagen el nombre de la imagen
        if($imagen){
            $this -> imagen = $imagen;
        }
    }

    //Eliminar el archivo
    public function borrarImagen(){
        //Comprobar si existe el archivo
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this -> imagen);
        if($existeArchivo){
            unlink(CARPETA_IMAGENES . $this -> imagen);
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

        if(!$this -> imagen){
                self::$errores[] = "La imagen es obligatoria";
        }
        
        return self::$errores;
    }

    //Lista todos los registros
    public static function all(){
        $query = "SELECT * FROM propiedades";

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    //Busca un registro por su id
    public static function find($id){
        $query = "SELECT * FROM propiedades WHERE id = ${id}";

        $resultado = self::consultarSQL($query);

        return array_shift($resultado);//retorna la primera posicion

    }

    public static function consultarSQL($query){
        //Consultar la base de datos
        $resultado = self::$db -> query($query);

        //Iterar los resultados
        $array = [];
        while($registro = $resultado -> fetch_assoc()){
            $array[] = self::crearObjeto($registro);
        }

        // debuguear($array);

        //Liberar la memoria
        $resultado -> free();


        //Retornar los resultados
        return $array;
    }

    protected static function crearObjeto($registro){//transforma el array en objeto
        $objeto = new self;

        foreach($registro as $key => $value){
            if(property_exists($objeto, $key)){//property_exists: verifica que la propiedad exista
                $objeto -> $key = $value;//una vez que verifique que exista el objeto le asigna el valor

            }
        }
                    
        return $objeto;
    }

    //Sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar( $args = []){
        foreach($args as $key => $value){
            if(property_exists($this, $key) && !is_null($value)){//this hace referencia al obejto actual
                $this -> $key = $value;
            }
        }
    }

}


?>