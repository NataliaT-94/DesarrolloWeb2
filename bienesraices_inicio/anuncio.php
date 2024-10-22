<?php

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('Location: /');
    }

    //Importar la conexion
    require 'includes/config/database.php';
    $db = conectarDB();
    
    //Consultar
    $query = "SELECT * FROM propiedades WHERE id = ${id}";

    
    //Obtener resultados
    $resultado = mysqli_query($db, $query);

    if(!$resultado -> num_rows){//si no tiene un numero de id valido redireccionar a la pagina principal
        header('Location:/');
    }


    $propiedad = mysqli_fetch_assoc($resultado);


    require 'includes/funciones.php';

    incluirTemplate('header');


?>
    
    <main class="contenedor seccion contenido-centrado">
        <h1><?php echo $propiedad['titulo']; ?></h1>

        <img loading="lazy" src=/imagenes/<?php echo $propiedad['imagen']; ?>" alt="Imagen de la propiedad">

        <div class="resumen-propiedad">
            <p class="precio">$<?php echo $propiedad['precio']; ?></p>
            
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                    <p><?php echo $propiedad['banio']; ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p><?php echo $propiedad['habitaciones']; ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                    <p><?php echo $propiedad['estacionamiento']; ?></p>
                </li>
            </ul>

            <?php echo $propiedad['descripcion']; ?>

        </div>
    </main>

    <?php 

        mysqli_close($db);

        incluirTemplate('footer' );

    ?>