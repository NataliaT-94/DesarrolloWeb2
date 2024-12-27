<div class="contenedor-anuncios">
    <?php foreach($vehiculos as $vehiculo): ?>
            <div class="anuncio">
                <img loading="lazy" src="/imagenes/<?php echo $vehiculo->imagen; ?>" alt="anuncio">


                <div class="contenido-anuncio">
                    <h3><?php echo $vehiculo->titulo; ?></h3>
                    <p><?php echo $vehiculo->descripcion; ?></p>
                    <p class="precio">$<?php echo $vehiculo->precio; ?></p>

                    <ul class="iconos-caracteristicas">
                        <li>
                            <img class="icono" loading="lazy" src="build/img/car_key_d9cncoh02xtz.svg"  alt="icono ">
                            <p><?php echo $vehiculo->modelo; ?></p>
                        </li>
                        <li>
                            <img class="icono" loading="lazy" src="build/img/car_433tzimfitbx.svg" alt="icono ">
                            <p><?php echo $vehiculo->puertas; ?></p>
                        </li>
                        <li>
                            <img class="icono" loading="lazy" src="build/img/motor_69xol7zxvoaa.svg" alt="icono ">
                            <p><?php echo $vehiculo->motor; ?></p>
                        </li>
                    </ul>

                    <a href="/vehiculo?id=<?php echo $vehiculo->id; ?>" class="boton-amarillo-block">
                        Ver Vehiculo
                    </a>
                </div><!----  .contenido-anuncio  ---->
            </div><!----  .anuncio  ---->
            <?php endforeach; ?>
        </div><!----  .contenedor-anuncios  ---->
