<?php
    use Model\Vehiculo;

    if($_SERVER['SCRIPT_NAME'] === '/anuncios.php'){
        $vehiculos = Vehiculo::all();
    } else {
        $vehiculos = Vehiculo::get(3);
    }


?>


<div class="contenedor-anuncios">
    <?php foreach($vehiculos as $vehiculo): ?>
            <div class="anuncio">
                <img loading="lazy" src="/imagenes/<?php echo $vehiculo -> imagen; ?>" alt="anuncio">


                <div class="contenido-anuncio">
                    <h3><?php echo $vehiculo -> titulo; ?></h3>
                    <p><?php echo $vehiculo -> descripcion; ?></p>
                    <p class="precio">$<?php echo $vehiculo -> precio; ?></p>

                    <ul class="iconos-caracteristicas">
                        <li>
                            <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                            <p><?php echo $vehiculo -> modelo; ?></p>
                        </li>
                        <li>
                            <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                            <p><?php echo $vehiculo -> puertas; ?></p>
                        </li>
                        <li>
                            <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                            <p><?php echo $vehiculo -> motor; ?></p>
                        </li>
                    </ul>

                    <a href="anuncio.php?id=<?php echo $vehiculo -> id; ?>" class="boton-amarillo-block">
                        Ver Vehiculo
                    </a>
                </div><!----  .contenido-anuncio  ---->
            </div><!----  .anuncio  ---->
            <?php endforeach; ?>
        </div><!----  .contenedor-anuncios  ---->
