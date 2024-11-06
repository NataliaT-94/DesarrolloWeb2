<?php

use App\Propiedad;
use App\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

    require '../../includes/app.php';
    estaAutenticado();

    // Validar la URL por ID valido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('Location: /admin');
    }

    //Obtener los datos de la propiedad
    $propiedad = Propiedad::find($id);

    //Consultar para obtener todos los vendedores
    $vendedores = Vendedor::all();
    
    //Array con mensajes de errores
    $errores = Propiedad::getErrores();


  //Ejecutar el codigo despues de que el usuario envia el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {//nos trae informacion detallada del servidor
      // Opcional: Mostrar los datos recibidos para depuración


        //Asignar los atributos
        $args = $_POST['propiedad'];
     
        $propiedad -> sincronizar($args);

        //Validacion
        $errores = $propiedad -> validar();

        //Subida de archivos
            //Generar un nombre unico
        $nombreImagen = md5(uniqid(rand(),true)) . ".jpg";
        if($_FILES['propiedad']['tmp_name']['imagen']){ 
            // //Realiza un resize a la imagen con intervention
            // $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);

            if (move_uploaded_file($_FILES['propiedad']['tmp_name']['imagen'], CARPETA_IMAGENES . $nombreImagen)) {
                // echo 'OK';
             }else{
                // echo 'FALLO';
             }

            $propiedad -> setImagen($nombreImagen);
        }


        if(empty($errores)){
        // if($_FILES['propiedad']['tmp_name']['imagen']){ --NO FUNCIONA

            //ALmacenar la imagen
            // $imagen -> save(CARPETA_IMAGENES . $nombreImagen);--NO FUNCIONA
        //}
            $propiedad -> guardar();          
        }
    }


    incluirTemplate('header');
?>
    
    
    <main class="contenedor seccion">
        <h1>Actualizar Propiedades</h1> 

        <a href="http://localhost/GitHub/DesarrolloWeb2/bienesraices_inicio/admin/" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>

        <?php endforeach; ?>

        <form class="formulario" method="POST" enctype="multipart/form-data"> <!-- enctype= sirve para subir archivos al formulario--------->
            <!-- GET: guarda la informacion en la URL, se comunica con el name: titulo// no es recomendable para mandar datos a un servidor, porque expone los datos en la URL -->
            <!-- POST: maneja internamente en el archivo, se comunica con el name: titulo // envia datos de forma segura -->
 
            <?php include '../../includes/templates/formulario_propiedades.php'; ?>


            <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
        </form>

    </main>

    <?php 
        incluirTemplate('footer' );
    ?>