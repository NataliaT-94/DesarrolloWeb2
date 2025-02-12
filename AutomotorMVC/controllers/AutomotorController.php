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
        $alertas = Vehiculo::getAlertas();
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $vehiculo = new Vehiculo($_POST['vehiculo']);
    
            /** Subida de Archivos */
            // Generar un nombre único
            $nombreImagen = md5(uniqid(rand(), true));
    
            // Validar la imagen
            if (!empty($_FILES['vehiculo']['tmp_name']['imagen'])) {
                // Crear imagen desde archivo subido
                $imagen_original = @imagecreatefromstring(file_get_contents($_FILES['vehiculo']['tmp_name']['imagen']));
    
                if ($imagen_original !== false) {
                    // Obtener tamaño original
                    $ancho_original = imagesx($imagen_original);
                    $alto_original = imagesy($imagen_original);
    
                    // Definir nuevo tamaño (800x600)
                    $nuevo_ancho = 800;
                    $nuevo_alto = 600;
    
                    // Crear lienzo en blanco
                    $imagen_redimensionada = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
    
                    // Redimensionar la imagen
                    imagecopyresampled(
                        $imagen_redimensionada,
                        $imagen_original,
                        0, 0, 0, 0,
                        $nuevo_ancho, $nuevo_alto,
                        $ancho_original, $alto_original
                    );
    
                    // Asignar el nombre de la imagen al objeto Vehiculo
                    $vehiculo->setImagen($nombreImagen);
                }
            }
    
            // Validar
            $alertas = $vehiculo->validar();
    
            if (empty($alertas) && isset($imagen_redimensionada)) {
                // Crear carpeta si no existe
                $carpetaImagenes = '../public/img/automotor';
                if (!is_dir($carpetaImagenes)) {
                    mkdir($carpetaImagenes, 0755, true);
                }
    
                // Guardar la imagen en formato JPEG
                imagejpeg($imagen_redimensionada, $carpetaImagenes . $nombreImagen . '.jpg', 80);
    
                // Guardar la imagen en formato WEBP
                imagewebp($imagen_redimensionada, $carpetaImagenes . $nombreImagen . '.webp', 80);
    
                // Liberar memoria
                imagedestroy($imagen_original);
                imagedestroy($imagen_redimensionada);
    
                // Guardar en la base de datos
                $resultado = $vehiculo->guardar();
    
                if ($resultado) {
                    header('location: /vehiculos');
                    exit;
                }
            }
        }
    
        $router->render('vehiculos/crear', [
            'vehiculo' => $vehiculo,
            'vendedores' => $vendedores,
            'alertas' => $alertas
        ]);
    }
    
    
    public static function actualizar(Router $router){
        $id = validarORedireccionar('/admin');
        $vehiculo = Vehiculo::find($id);
        $vendedores = Vendedor::all();
        $alertas = Vehiculo::getAlertas();

        //Metodo POST para actualizar
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {//nos trae informacion detallada del servidor
            // Opcional: Mostrar los datos recibidos para depuración
      
              //Asignar los atributos
              $args = $_POST['vehiculo'];
           
              $vehiculo -> sincronizar($args);
      
              //Validacion
              $alertas = $vehiculo -> validar();
      
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
      
              if(empty($alertas)){
 
                $resultado = $vehiculo -> guardar();
                  if($resultado) {
                    header('location: /admin');
                }          
              }
          }

        $router -> render('/vehiculos/actualizar', [
            'vehiculo' => $vehiculo,
            'vendedores' => $vendedores,
            'alertas' => $alertas
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