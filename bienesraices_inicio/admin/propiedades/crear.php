<?php 

    //Base de datos
    require '../../includes/config/database.php';
    $db = conectarDB();

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

    $titulo = '';
    $precio = '';
    $descripcion = '';
    $habitaciones = '';
    $banio = '';
    $estacionamiento = '';
    $vendedorId = '';

  //Ejecutar el codigo despues de que el usuario envia el formulario
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Opcional: Mostrar los datos recibidos para depuración
        //   echo "<pre>";
        //   var_dump($_POST);
        //   echo "</pre>";
  
      // Sanitizar y asignar variables
      $titulo = $_POST['titulo'];
      $precio = $_POST['precio'];
      $descripcion = $_POST['descripcion'];
      $habitaciones = $_POST['habitaciones'];
      $banio = $_POST['banio'];
      $estacionamiento = $_POST['estacionamiento'];
      $vendedorId = $_POST['vendedor'];
      $creado = date('y/m/d');

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

    //   echo "<pre>";
    //   var_dump($errores);
    //   echo "</pre>";

    //   exit;

      //Revisar que el array de $errores ese vacio 

      if(empty($errores)){//si el array de $errores esta vacio

            // insertar base de datos
            $query = "INSERT INTO propiedades (titulo, precio, descripcion, habitaciones, banio, estacionamiento, creado, vendedorId) 
            VALUES ('$titulo', '$precio', '$descripcion', '$habitaciones', '$banio', '$estacionamiento', $creado, '$vendedorId')";
        

            //echo $query;

            $resultado = mysqli_query($db, $query);

            if($resultado){
                //Redireccionar al usuario
                header('Location: http://localhost/GitHub/DesarrolloWeb2/bienesraices_inicio/admin/');

            } else{
                echo "Error: " . mysqli_error($db);
            }
        }
  }



    require '../../includes/funciones.php';
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

        <form class="formulario" method="POST" action="http://localhost/GitHub/DesarrolloWeb2/bienesraices_inicio/admin/propiedades/crear.php">
            <!-- GET: guarda la informacion en la URL, se comunica con el name: titulo// no es recomendable para mandar datos a un servidor, porque expone los datos en la URL -->
            <!-- POST: maneja internamente en el archivo, se comunica con el name: titulo // envia datos de forma segura -->
            <fieldset>
                <legend>Informacion General</legend>
                
                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo; ?>">
                
                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $preci0; ?>">
                
                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png">
                
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

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>

    </main>

    <?php 
        incluirTemplate('footer' );
    ?>