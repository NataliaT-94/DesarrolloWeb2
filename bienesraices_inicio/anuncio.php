<?php 
        require 'includes/funciones.php';

        incluirTemplate('header');
?>
    
    <main class="contenedor seccion contenido-centrado">
        <h1>Casa en Venta frente al bosque</h1>

        <picture>
            <source srcset="build/img/destacada.avif" type="image/avif">
            <source srcset="build/img/destacada.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada.jpg" alt="Imagen de la propiedad">
        </picture>

        <div class="resumen-propiedad">
            <p class="precio">$3.000.000</p>
            
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                    <p>3</p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p>3</p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                    <p>4</p>
                </li>
            </ul>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi repudiandae ipsa in maiores, pariatur illo iusto! Facilis deserunt, placeat tempora cupiditate voluptates eveniet provident fuga, dolorum expedita quo accusamus fugit?Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et non deleniti quia aliquam doloremque harum, ea, assumenda impedit nulla fuga amet, officiis corrupti nemo odio delectus sed unde atque iste?</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi repudiandae ipsa in maiores, pariatur illo iusto! Facilis deserunt, placeat tempora cupiditate voluptates eveniet provident fuga, dolorum expedita quo accusamus fugit?</p>

        </div>
    </main>

    <?php 

        incluirTemplate('footer' );

    ?>