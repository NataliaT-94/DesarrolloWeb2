<?php
namespace Model;

class Admin extends ActiveRecord{
    //Base de datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'email', 'password'];

    //Recomendacion colocar el mismo nombre que las tablas del bd
    public $id;
    public $email;
    public $password;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
    }

    public function validar(){
        if(!$this->email){
            self::$alertas[] = 'El Email es obligatorio';
        }
        if(!$this->password){
            self::$alertas[] = 'El Password es obligatorio';
        }

        return self::$alertas;
    }

    public function existeUsuario(){
        //Revisar si un usuario existe o no
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email  . "' LIMIT 1";
        $resultado = self::$db->query($query);

        // debuguear($resultado);

        if(!$resultado->num_rows){
            self::$alertas[] = 'El Usuario no existe';
            return;
        }

        return $resultado;
    }

    public function comprobarPassword($resultado){
        $usuario = $resultado->fetch_object();

        $autenticado = password_verify($this->password, $usuario->password);//permite verificar el password, primer parametro el password que ahy que com parar, segundo parametro es el password que esta almacenado en bd
        // $autenticado = false;
        // if($this->password == $usuario->password){
        //     $autenticado = true;
        // }
        if(!$autenticado){
            self::$alertas[] = 'El Password es incorrecto - entrada:' . $this->password . ' - bd: ' . $usuario->password;
        }
        return $autenticado;
    }

    public function autenticar(){
        session_start();

        //Llenar el arreglo de session
        $_SESSION['usuarios'] = $this->email;
        $_SESSION['login'] = true;

        header('Location: /admin');
    }
}

?>