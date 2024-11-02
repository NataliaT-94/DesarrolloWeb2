<?php 

    require '../../includes/app.php';



    use App\Propiedad;
    use App\Vendedor;
    use Intervention\Image\ImageManagerStatic as Image;

    estaAutenticado();


    $propiedad = new Propiedad;

    //Consultar para obtener todos los vendedores
    $vendedores = Vendedor::all();
    // debuguear($vendedores);

 
    //Array con mensajes de errores
    // $errores = [];
    $errores = Propiedad::getErrores();


  //Ejecutar el codigo despues de que el usuario envia el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {//nos trae informacion detallada del servidor
      // Opcional: Mostrar los datos recibidos para depuración
      
        /** Crea una nueva instancia */
        $propiedad = new Propiedad($_POST['propiedad']);

        /** SUBIDA DE ARCHIVOS */

        //Generar un nombre unico
        $nombreImagen = md5(uniqid(rand(),true)) . ".jpg";

        //Setear la imagen

        // if($_FILES['propiedad']['tmp_name']['imagen']){ --NO FUNCIONA
        //     //Realiza un resize a la imagen con intervention
        //     $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
        //     $propiedad -> setImagen($nombreImagen);
        // }

        //Validar
        $errores = $propiedad -> validar();

      //Revisar que el array de $errores ese vacio 

        if(empty($errores)){//si el array de $errores esta vacio

            //Crear carpeta

            // if(!is_dir(CARPETA_IMAGENES)){//verifica que la carpeta este creada o no- --NO FUNCIONA
            //     mkdir(CARPETA_IMAGENES);//crea galeria
            // }

            //Guarda la imagen en el servidor
            $image -> save(CARPETA_IMAGENES . $nombreImagen);
            

            //Guardar en la base de datos
            $propiedad -> guardar();

        }
    }


    incluirTemplate('header');
?>
    
    
    <main class="contenedor seccion">
        <h1>Crear</h1> 

        <a href="http://localhost/GitHub/DesarrolloWeb2/bienesraices_inicio/admin/" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>

        <?php endforeach; ?>

        <form class="formulario" method="POST" action="http://localhost/GitHub/DesarrolloWeb2/bienesraices_inicio/admin/propiedades/crear.php" enctype="multipart/form-data"> <!-- enctype= sirve para subir archivos al formulario--------->
            <!-- GET: guarda la informacion en la URL, se comunica con el name: titulo// no es recomendable para mandar datos a un servidor, porque expone los datos en la URL -->
            <!-- POST: maneja internamente en el archivo, se comunica con el name: titulo // envia datos de forma segura -->
            <?php include '../../includes/templates/formulario_propiedades.php'; ?>

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>

    </main>

    <?php 
        incluirTemplate('footer' );
    ?>