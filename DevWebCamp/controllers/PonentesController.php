<?php

namespace Controllers;

use Classes\Paginacion;
use MVC\Router;
use Model\Ponente;

class PonentesController {
    public static function index(Router $router){
        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if(!$pagina_actual || $pagina_actual <1){
            header('Location: /admin/ponentes?page=1');
        }
    
        $registros_por_pagina = 10;

        $total = Ponente::total();

        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total);
        $ponentes = Ponente::all();

        if(!is_admin()){
            header('Location: /login');
        }

        $router->render('admin/ponentes/index',[
            'titulo' => 'Ponentes / Conferencistas',
            'ponentes' => $ponentes,
            'paginacion' => $paginacion->paginacion()
        ]);
    }
        
    public static function crear(Router $router){
        if(!is_admin()){
            header('Location: /login');
        }

        $alertas = [];
        $ponente = new Ponente;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_admin()){
                header('Location: /login');
            }

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
            'ponente' => $ponente,
            'redes' => json_decode($ponente->redes)
        ]);
    }

    public static function editar(Router $router){
        if(!is_admin()){
            header('Location: /login');
        }

        $alertas = [];

        //validar el ID
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if(!$id){
            header('Location: /admin/ponente');
        }

        //Obtener ponente a Editar
        $ponente = Ponente::find($id);
        
        if(!$ponente){
            header('Location: /admin/ponente');
        }

        $ponente->imagen_actual = $ponente->imagen;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_admin()){
                header('Location: /login');
            }

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
            } else {
                $_POST['imagen'] = $ponente->imagen_actual;
            }
            $_POST['redes'] = json_encode($_POST['redes'], JSON_UNESCAPED_SLASHES);
            $ponente->sincronizar($_POST);
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

        //json_encode. toma el arreglo y lo transforma en string
        //json_decode. toma el string y lo transforma en objeto/json

        $router->render('admin/ponentes/editar',[
            'titulo' => 'Actualizar Ponente',
            'alertas' => $alertas,
            'ponente' => $ponente,
            'redes' => json_decode($ponente->redes)
        ]);
    }

    public static function eliminar(Router $router){
        if(!is_admin()){
            header('Location: /login');
        }
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $ponente = Ponente::find($id);

            if(!isset($ponente)){
                header('Location: /admin/ponentes');
            }

            $resultado = $ponente->eliminar();

            if($resultado){
                header('Location: /admin/ponentes');
            }

            $ponente->eliminar();
        }
    }
        
}

?>

