<?php 

 require 'includes/app.php';



    //$inicio = true; 
    //include './includes/templates/header.php';

    incluirTemplate('header', $inicio = true );
    

?>
    
    <main class="contenedor seccion">
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
    </main>

    <secction class="seccion contenedor">
        <h2>Casas y Depas en Venta</h2>

        <?php 
            $limite = 3;
            include 'includes/templates/anuncios.php';
        ?>

        <div class="alinear-derecha">
            <a href="anuncios.html" class="boton-verde">ver Todas</a>
        </div>
    </secction>

    <section class="imagen-contacto">
        <h2>Encuentra la casa de tus sueños</h2>
        <p>Llena el formulario de contacto y un asesor se podra en contacto contigo a la brevedad</p>
        <a href="contacto.html" class="boton-amarillo">Contactanos</a>
    </section>

    <div class="contenedor seccion seccion-inferior">
        <section class="blog">
            <h3>Nuestro Blog</h3>

            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog1.avif" type="image/avif">
                        <source srcset="build/img/blog1.jpg" type="image/jpeg">
                        <img loading="lazy" src="build/img/blog1.jpg" alt="Texto Entrada Blog">
                    </picture>
                </div>

                <div class="texto-entrada">
                    <a href="entrada.html">
                        <h4>Terraza en el techo de tu casa</h4>
                        <p class="informacion-meta">Escritorio el: <span>01/10/2024</span> por: <span>Admin</span></p>

                        <p>Consejos para construir una terraza en el techo de tu casa con los mejores materiales y ahorrando dinero</p>
                    </a>
                </div>
            </article>

            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog2.avif" type="image/avif">
                        <source srcset="build/img/blog2.jpg" type="image/jpeg">
                        <img loading="lazy" src="build/img/blog2.jpg" alt="Texto Entrada Blog">
                    </picture>
                </div>

                <div class="texto-entrada">
                    <a href="entrada.html">
                        <h4>Guia para la decoracion de tu hogar</h4>
                        <p class="informacion-meta">Escritorio el: <span>01/10/2024</span> por: <span>Admin</span></p>

                        <p>Consejos para construir una terraza en el techo de tu casa con los mejores materiales y ahorrando dinero</p>
                    </a>
                </div>
            </article>
        </section>

        <section class="testimoniales">
            <h3>Testimoniales</h3>
            <div class="testimonial">
                <blockquote>
                    el personal se comporto de una excelente forma, muy buena atencion y la casa que me ofrecieron cumple con todas mis expectativas.
                </blockquote>
                <p>- Natt Techeira -</p>
            </div>
        </section>
    </div>
    <?php 

        incluirTemplate('footer' );

    ?>