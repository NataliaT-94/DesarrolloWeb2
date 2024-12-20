<main class="contenedor seccion">
    <h1>Actualizar</h1>


    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <a href="/" class="boton boton-verde">Volver</a>
    
    <form action="/vehiculos/crear" method="POST" enctype="multipart/form-data">
        <?php include __DIR__ . '/formulario.php'; ?>

        <input type="submit" value="Actualizar Vehiculo" class="boton boton-verde">
    </form>
</main>
