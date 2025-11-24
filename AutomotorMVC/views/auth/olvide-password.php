<h1 class="nombre-pagina">Olvide mi Contraseña</h1>
<p class="descripcion-pagina">Reeestablece tu contraseña escribiendo tu E-mail a continuacion</p>

<?php
include_once __DIR__ . "/../templates/alertas.php";
?>

<form class="formulario" method="POST" action="olvide">
    <div class="campo">
        <label for="email">E-mail</label>
        <input type="email" name="email" id="email" placeholder="Tu E-mail">
    </div>

    <input type="submit" class="boton boton-verde" value="Enviar Instrucciones">

</form>

<div class="acciones">
    <a href="">¿Ya tienes una cuenta? Inicia Sesion</a>
    <a href="crear-cuenta">¿Aun no tienes una cuenta? Crea una</a>
</div>