<div class="barra-mobile">
    <h1>UpTask</h1>
    <div class="menu">
        <img id="mobile-menu" src="build/img/free_icon_2.svg" alt="imagen menu">
    </div>
</div>

<div class="barra">
    <p>Hola: <span><?php echo $_SESSION['nombre']; ?></span></p>

    <a href="/logout" class="cerrar-sesion">Cerrar Sesion</a>
</div>

<?php $script =' 
        <script src="build/js/bundle.js"></script>
    ';


    ?>