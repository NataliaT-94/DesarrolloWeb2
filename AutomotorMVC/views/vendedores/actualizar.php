<main class="contenedor seccion">
    <h1>Actualizar Vendedor: <?php echo s($vendedor->nombre) . " " . s($vendedor->apellido); ?> </h1>

    <a href="/" class="boton boton-verde">Volver</a>

    <?php foreach($errores as $error): ?>
    <div class="alerta error">
        <?php echo $error; ?>
    </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" >
        <?php include 'formulario.php'; ?>
        <input type="submit" value="Actualizar vendedor" class="boton boton-verde">
    </form>
</main>