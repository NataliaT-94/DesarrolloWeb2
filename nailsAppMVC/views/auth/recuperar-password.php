<h1 class="nombre-pagina">Reestablecer Contraseña</h1>
<p class="descripcion-pagina">Ingresa tu nueva contraseña a continuacion</p>

<?php
include_once __DIR__ . "/../templates/alertas.php";
?>

<?php
    if($error) return null; ;
?>



<form class="formulario" method="POST">
    <div class="campo">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Tu Nuevo Password">
    </div>

    <input type="submit" class="boton" value="Guardar Nueva Contraseña">

</form>

<div class="acciones">
    <a href="/">¿Ya tienes Cuenta? Inicia Sesion</a>
    <a href="/crear-cuenta">¿Aun no tienes Cuenta? Crear Cuenta</a>
</div>