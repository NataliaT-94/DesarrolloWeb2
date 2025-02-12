<?php

namespace Controllers;

use MVC\Router;
use Model\Ponente;

class PonentesController {
    public static function index(Router $router){
        $router->render('admin/ponentes/index',[
            'titulo' => 'Ponentes / Conferencistas'
        ]);
    }
        
    public static function crear(Router $router){
        $alertas = [];
        $ponente = new Ponente;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            //leer imagen
            if(!empty($_FILES['imagen']['tmp_name'])){
                $carpeta_imagenes = '../public/img/speakers';

                //Crear la carpeta si no existe
                if(!is_dir($carpeta_imagenes)){
                    mkdir($carpeta_imagenes, 0755, true);
                }
                // Crear la imagen desde el archivo subido
                $imagen_original = @imagecreatefromstring(file_get_contents($_FILES['imagen']['tmp_name']));
                if ($imagen_original === false) {
                    $alertas[] = "Error al procesar la imagen.";
                } else {
                    // Obtener tamaño original
                    $ancho_original = imagesx($imagen_original);
                    $alto_original = imagesy($imagen_original);

                    // Definir nuevo tamaño (800x800)
                    $nuevo_ancho = 800;
                    $nuevo_alto = 800;

                    // Crear lienzo en blanco
                    $imagen_redimensionada = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);

                    // Mantener transparencia si es PNG
                    imagealphablending($imagen_redimensionada, false);
                    imagesavealpha($imagen_redimensionada, true);

                    // Redimensionar imagen
                    imagecopyresampled(
                        $imagen_redimensionada,
                        $imagen_original,
                        0, 0, 0, 0,
                        $nuevo_ancho, $nuevo_alto,
                        $ancho_original, $alto_original
                    );
                // Generar nombre de archivo
                $nombre_imagen = md5(uniqid(rand(), true));
                $_POST['imagen'] = $nombre_imagen;
                
                    // Liberar memoria
                    imagedestroy($imagen_original);
                    imagedestroy($imagen_redimensionada);
                }
            }

            $_POST['redes'] = json_encode($_POST['redes'], JSON_UNESCAPED_SLASHES);

            $ponente->sincronizar($_POST);

            //validar
            $alertas = $ponente->validar();

            //Guardar el registro
            if(empty($alertas)){
                // Guardar la imagen en PNG
                imagepng($imagen_redimensionada, "$carpeta_imagenes/$nombre_imagen.png", 8);
                // Guardar la imagen en WebP
                imagewebp($imagen_redimensionada, "$carpeta_imagenes/$nombre_imagen.webp", 80);

                //Guardar en la BD
                $resultado = $ponente->guardar();

                if($resultado){
                    header('Location: /admin/ponentes');
                }
            }
        }
        
        $router->render('admin/ponentes/crear',[
            'titulo' => 'Registrar Ponente',
            'alertas' => $alertas,
            'ponente' => $ponente
        ]);
    }
        
}

?>

