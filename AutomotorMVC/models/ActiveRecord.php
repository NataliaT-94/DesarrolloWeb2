<?php
namespace Model;

use mysqli;
use Dotenv\Dotenv;

class ActiveRecord {

    // BASE DE DATOS
    protected static $db;
    protected static $tabla = '';
    protected static $columnasDB = [];

    // ALERTAS
    protected static $alertas = [];

    // -----------------------------
    // Cargar conexión desde .env
    // -----------------------------
    public static function initDB() {
        if (!self::$db) {


            // Crear la conexión
            self::$db = new mysqli(
                $_ENV['BD_HOST'],
                $_ENV['BD_USER'],
                $_ENV['BD_PASS'],
                $_ENV['BD_NAME']
            );

            if (self::$db->connect_error) {
                die("Error de conexión a la BD: " . self::$db->connect_error);
            }
        }
    }

    // -----------------------------
    // Alertas
    // -----------------------------
    public static function setAlerta($tipo, $mensaje) {
        self::$alertas[$tipo][] = $mensaje;
    }

    public static function getAlertas() {
        return static::$alertas;
    }

    public function validar() {
        static::$alertas = [];
        return static::$alertas;
    }

    // -----------------------------
    // CRUD
    // -----------------------------
    public function guardar() {
        return !is_null($this->id) ? $this->actualizar() : $this->crear();
    }

    public static function all() {
        self::initDB();
        $query = "SELECT * FROM " . static::$tabla;
        return self::consultarSQL($query);
    }

    public static function find($id) {
        self::initDB();
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = " . intval($id);
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    public static function get($cantidad) {
        self::initDB();
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . intval($cantidad);
        return self::consultarSQL($query);
    }

    public static function where($columna, $valor) {
        self::initDB();
        $columna = self::$db->real_escape_string($columna);
        $valor = self::$db->real_escape_string($valor);
        $query = "SELECT * FROM " . static::$tabla . " WHERE {$columna} = '{$valor}'";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    public function crear() {
        self::initDB();
        $atributos = $this->sanitizarAtributos();
        $query = "INSERT INTO " . static::$tabla . " (" . join(', ', array_keys($atributos)) . ") 
                  VALUES ('" . join("', '", array_values($atributos)) . "')";
        return self::$db->query($query) ?: die("Error en INSERT: " . self::$db->error);
    }

    public function actualizar() {
        self::initDB();
        $atributos = $this->sanitizarAtributos();
        $valores = [];
        foreach ($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }
        $query = "UPDATE " . static::$tabla . " SET " . join(', ', $valores) . 
                 " WHERE id = '" . self::$db->escape_string($this->id) . "' LIMIT 1";
        return self::$db->query($query) ?: die("Error en UPDATE: " . self::$db->error);
    }

    public function eliminar() {
        self::initDB();
        $query = "DELETE FROM " . static::$tabla . " WHERE id = '" . self::$db->escape_string($this->id) . "' LIMIT 1";
        $resultado = self::$db->query($query) ?: die("Error en DELETE: " . self::$db->error);

        if ($resultado) {
            $this->borrarImagen();
        }
        return $resultado;
    }

    // -----------------------------
    // Consultas seguras
    // -----------------------------
    public static function consultarSQL($query) {
        self::initDB();
        $resultado = self::$db->query($query);

        if (!$resultado) {
            die("Error en la consulta SQL: " . self::$db->error . " | Query: " . $query);
        }

        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        $resultado->free();
        return $array;
    }

    protected static function crearObjeto($registro) {
        $objeto = new static;
        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

    // -----------------------------
    // Atributos y sanitización
    // -----------------------------
    public function atributos() {
        $atributos = [];
        foreach (static::$columnasDB as $columna) {
            if ($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarAtributos() {
        self::initDB();
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    public function sincronizar($args = []) {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }

    // -----------------------------
    // Manejo de imágenes
    // -----------------------------
    public function setImagen($imagen) {
        if (!is_null($this->id)) {
            $this->borrarImagen();
        }
        if ($imagen) {
            $this->imagen = $imagen;
        }
    }

    public function borrarImagen() {
        if (defined('CARPETA_IMAGENES') && file_exists(CARPETA_IMAGENES . $this->imagen)) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }
}
?>
