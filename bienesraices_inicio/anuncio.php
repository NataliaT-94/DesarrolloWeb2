<?php
    require 'includes/app.php';

    use App\Propiedad;

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('Location: /');
    }

    $propiedad = Propiedad::find($id);


    incluirTemplate('header');


?>
    
    <main class="contenedor seccion contenido-centrado">
        <h1><?php echo $propiedad -> titulo; ?></h1>

        <img loading="lazy" src=/imagenes/<?php echo $propiedad -> imagen; ?>" alt="Imagen de la propiedad">

        <div class="resumen-propiedad">
            <p class="precio">$<?php echo $propiedad -> precio; ?></p>
            
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                    <p><?php echo $propiedad -> banio; ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p><?php echo $propiedad -> habitaciones; ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                    <p><?php echo $propiedad -> estacionamiento; ?></p>
                </li>
            </ul>

            <?php echo $propiedad -> descripcion; ?>

        </div>
    </main>

    <?php

        incluirTemplate('footer' );

    ?>