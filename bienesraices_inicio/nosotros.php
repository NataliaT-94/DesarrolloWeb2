<?php 
     //require 'includes/funciones.php';
     require 'includes/app.php';

 
     incluirTemplate('header');
?>
    
    
    <main class="contenedor seccion">
        <h1>Conoce sobre Nosotros</h1>

        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.avif" type="image/avif">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre nosotros">
                </picture>
            </div>

            <div class="texto-nosotros">
                <blockquote>
                    25 Años de Experiencia
                </blockquote>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi repudiandae ipsa in maiores, pariatur illo iusto! Facilis deserunt, placeat tempora cupiditate voluptates eveniet provident fuga, dolorum expedita quo accusamus fugit?Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et non deleniti quia aliquam doloremque harum, ea, assumenda impedit nulla fuga amet, officiis corrupti nemo odio delectus sed unde atque iste?</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi repudiandae ipsa in maiores, pariatur illo iusto! Facilis deserunt, placeat tempora cupiditate voluptates eveniet provident fuga, dolorum expedita quo accusamus fugit?</p>
            </div>
        </div>
    </main>
    <section class="contenedor seccion">
        <h1>Mas sobre Nosotros</h1>
        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono precio" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eum blanditiis et ullam maxime, rem aspernatur quisquam optio? Blanditiis atque quia nostrum consequatur aliquam, tempora repellendus eligendi deserunt repudiandae vero voluptatibus.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono precio" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eum blanditiis et ullam maxime, rem aspernatur quisquam optio? Blanditiis atque quia nostrum consequatur aliquam, tempora repellendus eligendi deserunt repudiandae vero voluptatibus.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono precio" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eum blanditiis et ullam maxime, rem aspernatur quisquam optio? Blanditiis atque quia nostrum consequatur aliquam, tempora repellendus eligendi deserunt repudiandae vero voluptatibus.</p>
            </div>
        </div>
    </section>

    <?php 
        incluirTemplate('footer' );
    ?>