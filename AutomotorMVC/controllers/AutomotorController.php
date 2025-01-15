<?php
namespace Controllers;
use MVC\Router;
use Model\Vehiculo;
use Model\Vendedor;




class AutomotorController{
    public static function index(Router $router){
        $vehiculos = Vehiculo::all();
        // var_dump($vehiculos); // Depuración
        // exit; // Detén la ejecución para comprobar los datos
        $vendedores = Vendedor::all();
    
        //Muestra mesaje condicional
        $resultado = $_GET['resultado'] ?? null;

        $router -> render('/vehiculos/admin', [
            'vehiculos' => $vehiculos,
            'vendedores' => $vendedores,
            'resultado' => $resultado
        ] );
    }
    public static function crear(Router $router) {
        $vehiculo = new Vehiculo;
        $vendedores = Vendedor::all();
        $errores = Vehiculo::getErrores();
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $vehiculo = new Vehiculo($_POST['vehiculo']);
    
            // Generar un nombre único
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
    
            // Validar la imagen
            if (isset($_FILES['vehiculo']['tmp_name']['imagen']) && !empty($_FILES['vehiculo']['tmp_name']['imagen'])) {
                $imagenTmp = $_FILES['vehiculo']['tmp_name']['imagen']; // Archivo temporal
                $vehiculo->setImagen($nombreImagen);
            
                // Crear carpeta si no existe
                $carpetaImagenes = '../../imagenes/';
                if (!is_dir($carpetaImagenes)) {
                    mkdir($carpetaImagenes);
                }
            
                // Subir la imagen
                move_uploaded_file($imagenTmp, $carpetaImagenes . $nombreImagen);
            }
            
    
            // Validar
            $errores = $vehiculo->validar();
            if (empty($errores)) {
                // Guarda en la base de datos
                $resultado = $vehiculo->guardar();
    
                if ($resultado) {
                    header('location: /vehiculos');
                }
            }
        }
    
        $router->render('/vehiculos/crear', [
            'vehiculo' => $vehiculo,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }
    
    
    public static function actualizar(Router $router){
        $id = validarORedireccionar('/admin');
        $vehiculo = Vehiculo::find($id);
        $vendedores = Vendedor::all();
        $errores = Vehiculo::getErrores();

        //Metodo POST para actualizar
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {//nos trae informacion detallada del servidor
            // Opcional: Mostrar los datos recibidos para depuración
      
              //Asignar los atributos
              $args = $_POST['vehiculo'];
           
              $vehiculo -> sincronizar($args);
      
              //Validacion
              $errores = $vehiculo -> validar();
      
              //Subida de archivos
                  //Generar un nombre unico
              $nombreImagen = md5(uniqid(rand(),true)) . ".jpg";
              if($_FILES['vehiculo']['tmp_name']['imagen']){ 
      
                  if (move_uploaded_file($_FILES['vehiculo']['tmp_name']['imagen'], CARPETA_IMAGENES . $nombreImagen)) {
                      // echo 'OK';
                   }else{
                      // echo 'FALLO';
                   }
      
                  $vehiculo -> setImagen($nombreImagen);
              }
      
              if(empty($errores)){
 
                $resultado = $vehiculo -> guardar();
                  if($resultado) {
                    header('location: /admin');
                }          
              }
          }

        $router -> render('/vehiculos/actualizar', [
            'vehiculo' => $vehiculo,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function eliminar(Router $router) {

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tipo = $_POST['tipo'];

            // peticiones validas
            if(validarTipoContenido($tipo) ) {
                // Leer el id
                $id = $_POST['id'];
                $id = filter_var($id, FILTER_VALIDATE_INT);
    
                // encontrar y eliminar la propiedad
                $vehiculo = Vehiculo::find($id);
                $resultado = $vehiculo->eliminar();

                // Redireccionar
                if($resultado) {
                    header('location: /admin');
                }
            }
        }
    }
}
?> 