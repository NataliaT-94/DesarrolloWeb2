<main class="contenedor seccion">
    <h1>Actualizar</h1>

    <a href="/vehiculos" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>


    
    <form class="formulario" action="/vehiculos/crear" method="POST" enctype="multipart/form-data">
        <?php include __DIR__ . '/formulario.php'; ?>

        <input type="submit" value="Actualizar Vehiculo" class="boton boton-verde">
    </form>
</main>
