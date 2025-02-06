<main class="contenedor seccion">
    <h1>Actualizar</h1>

    <a href="/vehiculos" class="boton boton-verde">Volver</a>

        <?php
            include_once __DIR__ . "/../templates/alertas.php";
        ?>
    
    <form class="formulario" action="/vehiculos/crear" method="POST" enctype="multipart/form-data">
        <?php include __DIR__ . '/formulario.php'; ?>

        <input type="submit" value="Actualizar Vehiculo" class="boton boton-verde">
    </form>
</main>
