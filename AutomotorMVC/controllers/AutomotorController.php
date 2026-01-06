<?php

namespace Controllers;


// var_dump("autoload?", class_exists('Intervention\\Image\\ImageManager'));

use MVC\Router;
use Model\Vehiculo;
use Model\Vendedor;


use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;



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
        $alertas = Vehiculo::getAlertas();
        $vehiculo = new Vehiculo;
        $vendedores = Vendedor::all();
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $vehiculo = new Vehiculo($_POST['vehiculo']);

            /** Subida de Archivos */
            // Generar un nombre único
            $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';

            // Procesar imagen con Intervention Image v3
            if (!empty($_FILES['vehiculo']['tmp_name']['imagen'])) {

                // $manager = new ImageManager(['driver' => 'gd']);
                $manager = new ImageManager(new Driver());

                // Cargar y recortar la imagen
                $image = $manager
                    ->read($_FILES['vehiculo']['tmp_name']['imagen'])
                    ->cover(800, 600); // equivalente moderno de fit()

                $vehiculo->setImagen($nombreImagen);
            }
    
        // Validación
            $alertas = $vehiculo->validar();

            if (empty($alertas)) {

                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES, 0755, true);
                }

                // Guardar la imagen en el servidor
                if (isset($image)) {
                    // $image->toFile(CARPETA_IMAGENES . $nombreImagen);
                    move_uploaded_file(
                        $_FILES['vehiculo']['tmp_name']['imagen'],
                        CARPETA_IMAGENES . $nombreImagen
                    );

                    // var_dump(CARPETA_IMAGENES . $nombreImagen);
                }

                // Guardar en BD
                $resultado = $vehiculo->guardar();

                if ($resultado) {
                    redirect('admin');
                }
            }
        }
    
        $router->render('vehiculos/crear', [
            'vehiculo' => $vehiculo,
            'vendedores' => $vendedores,
            'alertas' => $alertas
        ]);
    }
    
    
    public static function actualizar(Router $router) {

        $id = validarORedireccionar('/admin');
        $vehiculo = Vehiculo::find($id);
        $vendedores = Vendedor::all();
        $alertas = Vehiculo::getAlertas();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Sincronizar datos
            $args = $_POST['vehiculo'];
            $vehiculo->sincronizar($args);

            // Validar
            $alertas = $vehiculo->validar();

            // ✅ Hay nueva imagen?
            if (!empty($_FILES['vehiculo']['tmp_name']['imagen'])) {

                // Generar nombre nuevo
                $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';

                // Crear carpeta si no existe
                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES, 0755, true);
                }

                // ✅ Eliminar imagen anterior
                if ($vehiculo->imagen && file_exists(CARPETA_IMAGENES . $vehiculo->imagen)) {
                    unlink(CARPETA_IMAGENES . $vehiculo->imagen);
                }

                // ✅ Mover imagen nueva
                move_uploaded_file(
                    $_FILES['vehiculo']['tmp_name']['imagen'],
                    CARPETA_IMAGENES . $nombreImagen
                );

                // ✅ Asignar nueva imagen
                $vehiculo->setImagen($nombreImagen);
            }

            // Guardar cambios
            if (empty($alertas)) {
                $resultado = $vehiculo->guardar();
                if ($resultado) {
                    redirect('admin');
                }
            }
        }

        $router->render('/vehiculos/actualizar', [
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
                    redirect('admin');
                }
            }
        }
    }
}