<main class="contenedor seccion">
    <h1>Actualizar Vendedor: <?php echo s($vendedor->nombre) . " " . s($vendedor->apellido); ?> </h1>

    <a href="/" class="boton boton-verde">Volver</a>

    <?php
        include_once __DIR__ . "/../templates/alertas.php";
    ?>

    <form class="formulario" method="POST" >
        <?php include 'formulario.php'; ?>
        <input type="submit" value="Actualizar vendedor" class="boton boton-verde">
    </form>
</main>