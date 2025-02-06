<main class="contenedor seccion">
    <h1>Crear</h1>

    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php
        include_once __DIR__ . "/../templates/alertas.php";
    ?>


    
    <form class="formulario" action="/vehiculos/crear" method="POST" enctype="multipart/form-data">
        <?php include __DIR__ . '/formulario.php'; ?>

        <input type="submit" value="Crear Vehiculo" class="boton boton-verde">
    </form>
</main>
