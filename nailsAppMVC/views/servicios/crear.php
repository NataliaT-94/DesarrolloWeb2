<h1 class="nombre-pagina">Nuevo Servicios</h1>
<p class="descripcion-pagina">Llena todos los campos para añadir un nuevo servicio</p>

<?php 
    include_once __DIR__ . '/../templates/barra.php';
    include_once __DIR__ . '/../templates/alertas.php';
?>

<form action="/servicios/crear" method="POSt" class="formulario">
    <?php include_once 'formulario.php'; ?>
    <input type="submit" class="boton" value="Guardar Servicio">
</form>