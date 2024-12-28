<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $vehiculo->titulo; ?></h1>

    <img loading="lazy" src=/imagenes/<?php echo $vehiculo->imagen; ?>" alt="Imagen de la vehiculo">

    <div class="resumen-vehiculo">
        <p class="precio">$<?php echo $vehiculo->precio; ?></p>
            
        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono modelo">
                <p><?php echo $vehiculo->modelo; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono puertas">
                <p><?php echo $vehiculo->puertas; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono motor">
                <p><?php echo $vehiculo->motor; ?></p>
            </li>
        </ul>

        <?php echo $vehiculo->descripcion; ?>

    </div>
</main>