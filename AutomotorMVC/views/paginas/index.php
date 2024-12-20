<main class="contenedor seccion">
    <h1>Mas sobre Nosotros</h1>

    <?php include 'iconos.php';  ?>
</main>

<secction class="seccion contenedor">
    <h2>Vehiculos en venta en Venta</h2>

    <?php 
        $limite = 3;
        include 'listado.php';
    ?>

    <div class="alinear-derecha">
        <a href="/vehiculos" class="boton-verde">ver Todas</a>
    </div>
</secction>

<section class="imagen-contacto">
    <h2>Encuentra la casa de tus sueños</h2>
    <p>Llena el formulario de contacto y un asesor se podra en contacto contigo a la brevedad</p>
    <a href="/contacto" class="boton-amarillo">Contactanos</a>
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

                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque, aperiam architecto quas quam reiciendis voluptatibus expedita possimus a</p>
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

                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque, aperiam architecto quas quam reiciendis voluptatibus expedita possimus ao</p>
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