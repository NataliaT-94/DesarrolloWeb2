<?php 


    // Validar la URL por ID valido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('Location: /admin');
    }

    //Base de datos
    require '../../includes/config/database.php';
    $db = conectarDB();

    //Obtener los datos de la propiedad
    $consulta = "SELECT * FROM propiedades WHERE id = ${id}";
    $resultado = mysqli_query($db, $consulta);
    $propiedad = mysqli_fetch_assoc($resultado);


    //Consultar para obtener los vendedores
    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta);

    //para acceder a la info del POSt o GET
    // echo "<pre>";
    // var_dump($SERVER);//contiene toda la informacion del servidor
    // var_dump($_POST);
    // var_dump($_GET);
    // echo "<pre>";

    //Array con mensajes de errores
    $errores = [];

    $titulo = $propiedad['titulo'];
    $precio = $propiedad['precio'];
    $descripcion = $propiedad['descripcion'];
    $habitaciones = $propiedad['habitaciones'];
    $banio = $propiedad['banio'];
    $estacionamiento = $propiedad['estacionamiento'];
    $vendedorId = $propiedad['vendedorId'];
    $imagenPropiedad = $propiedad['imagen'];

  //Ejecutar el codigo despues de que el usuario envia el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {//nos trae informacion detallada del servidor
      // Opcional: Mostrar los datos recibidos para depuración
           echo "<pre>";
           var_dump($_POST);//nos trae la informacion ciando la enviamos por nuestro formulario
           echo "</pre>";


        //   echo "<pre>";
        //   var_dump($_FILES);// nos permite ver el contenido de los archivos
        //   echo "</pre>";

        
  
        // Sanitizar: sirve para proteger tu codigo //asignar variables
        $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
        $precio = mysqli_real_escape_string($db, $_POST['precio']);
        $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
        $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
        $banio = mysqli_real_escape_string($db, $_POST['banio']);
        $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
        $vendedorId = mysqli_real_escape_string($db, $_POST['vendedor']);
        $creado = date('Y/m/d');

        //asignar files hacia unavariable
        $imagen = $_FILES['imagen'];

        //var_dump($imagen['name']);

        //exit;

        if(!$titulo){//si no hay titulo
            $errores[] = "Debes añadir un titulo";
        }

        if(!$precio){
            $errores[] = "Debes añadir un precio";
        }

        if(strlen($descripcion) < 50){
            $errores[] = "La descripcion es oblidgatoria y debe tener al menos 50 caracteres";
        }

        if(!$habitaciones){
            $errores[] = "El numero de habitaciones es obligatorio";
        }

        if(!$banio){
            $errores[] = "El numero de banios es obligatorio";
        }

        if(!$estacionamiento){
            $errores[] = "El numero de estacionamientos es obligatorio";
        }

        if(!$vendedorId){
            $errores[] = "Elije un vendedor";
        }


        //Validar por tamaño (1mb maximo)
        $medida = 1000 * 1000;

        if($imagen['size'] > $medida){
                $errores[] = "La imagen es muuy pesada";
        }

                // echo "<pre>";
                // var_dump($errores);
                // echo "</pre>";

     

      //Revisar que el array de $errores ese vacio 

        if(empty($errores)){//si el array de $errores esta vacio

          //   /** SUBIDA DE ARCHIVOS */

             //Crear carpeta
            $carpetaImagenes = '../../imagenes/';

            if(!is_dir($carpetaImagenes)){//verifica que la carpeta este creada o no
                mkdir($carpetaImagenes);//crea galeria
            }

            $nombreImagen = '';

            if($imagen['name']){
                //Eliminar la imagen previa

                unlink($carpetaImagenes . $propiedad['imagen']);
                
                //Generar un nombre unico
                $nombreImagen = md5(uniqid(rand(),true)) . ".jpg";

                //Subir la imagen
                move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);

            } else {
                $nombreImagen = $propiedad['imagen'];
            }


            
            // insertar base de datos
            $query = " UPDATE propiedades SET titulo = '${titulo}',  precio = '${precio}',  imagen = '${nombreImagen}', descripcion = '${descripcion}',habitaciones = ${habitaciones},
             banio = ${banio}, estacionamiento = ${estacionamiento}, vendedorId = ${vendedorId} WHERE id = ${id} ";
            
 
            //echo $query;

            //exit;

            $resultado = mysqli_query($db, $query);

            if($resultado){
                //Redireccionar al usuario
                header('Location: http://localhost/GitHub/DesarrolloWeb2/bienesraices_inicio/admin?mensaje=2');

            } else{
                echo "Error: " . mysqli_error($db);
            }
        }
    }



    require '../../includes/funciones.php';
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
            <fieldset>
                <legend>Informacion General</legend>
                
                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo; ?>">
                
                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio; ?>">
                
                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

                <img src="/imagenes/<?php echo $imagenPropiedad ?>" class="imagen-small">
                
                <label for="descripcion">Descripcion:</label>
                <textarea id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea>
            </fieldset>

            <fieldset>
                <legend>Informacion Propiedad</legend>
                
                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo $habitaciones; ?>">
                
                <label for="baño">Baños:</label>
                <input type="number" id="baño" name="banio" placeholder="Ej: 3" min="1" max="9" value="<?php echo $banio; ?>">
                
                <label for="estacionamiento">Estacionamiento:</label>
                <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" min="1" max="9" value="<?php echo $estacionamiento; ?>">

            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>
                
                <select name="vendedor" value="<?php echo $vendedorId; ?>">
                    <option value="">-- Seleccione --</option>
                    <?php while($vendedor = mysqli_fetch_assoc($resultado)): ?>
                        <option <?php echo $vendedorId === $vendedor['id'] ? 'selected' : ''; ?> value="<?php echo $vendedor['id']?>">
                            <?php echo $vendedor['nombre']." ". $vendedor['apellido']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </fieldset>

            <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
        </form>

    </main>

    <?php 
        incluirTemplate('footer' );
    ?>