<h1 class="nombre-pagina">Actualizar Servicios</h1>
<p class="descripcion-pagina">Modificar los valores del Formulario</p>

<?php 
    include_once __DIR__ . '/../templates/barra.php';
    include_once __DIR__ . '/../templates/alertas.php';
?>

<form method="POSt" class="formulario">
    <?php include_once 'formulario.php'; ?>
    <input type="submit" class="boton" value="Actualizar">
</form>