<?php 
    require 'includes/funciones.php';

    incluirTemplate('header');
?>
    
    
    <main class="contenedor seccion contenido-centrado">
        <h1>Guia para la decoracion de tu hogar</h1>
        
        <picture>
            <source srcset="build/img/destacada2.avif" type="image/avif">
            <source srcset="build/img/destacada2.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada2.jpg" alt="Imagen de la propiedad">
        </picture>

        <p class="informacion-meta">Escritorio el: <span>01/10/2024</span> por: <span>Admin</span></p>
        
        <div class="resumen-propiedad">

            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi repudiandae ipsa in maiores, pariatur illo iusto! Facilis deserunt, placeat tempora cupiditate voluptates eveniet provident fuga, dolorum expedita quo accusamus fugit?Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et non deleniti quia aliquam doloremque harum, ea, assumenda impedit nulla fuga amet, officiis corrupti nemo odio delectus sed unde atque iste?</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi repudiandae ipsa in maiores, pariatur illo iusto! Facilis deserunt, placeat tempora cupiditate voluptates eveniet provident fuga, dolorum expedita quo accusamus fugit?</p>

        </div>
    </main>

    <?php 
        incluirTemplate('footer' );
    ?>