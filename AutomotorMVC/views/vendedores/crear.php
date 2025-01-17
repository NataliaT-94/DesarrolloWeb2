<main class="contenedor seccion">
    <h1>Registrar Vendedor(a)</h1> 

    <a href="/" class="boton boton-verde">Volver</a>

    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>

    <?php endforeach; ?>

    <form class="formulario" method="POST" action="/vendedores/crear">
        <!-- GET: guarda la informacion en la URL, se comunica con el name: titulo// no es recomendable para mandar datos a un servidor, porque expone los datos en la URL -->
        <!-- POST: maneja internamente en el archivo, se comunica con el name: titulo // envia datos de forma segura -->
        <?php include 'formulario.php';  ?>
        <input type="submit" value="Registrar Vendedor(a)" class="boton boton-verde">
    </form>

</main>