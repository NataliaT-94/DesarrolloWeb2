<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina"> Inicia sesion con tus datos</p>

<?php
include_once __DIR__ . "/../templates/alertas.php";
?>

<form class="formulario" method="POST" action="/">
    <div class="campo">
        <label for="email">E-mail</label>
        <input type="email" name="email" id="email" placeholder="Tu E-mail">
    </div>
    <div class="campo">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Tu Password">
    </div>

    <input type="submit" class="boton" value="Iniciar Sesion">

</form>

<div class="acciones">
    <a href="/crear-cuenta">¿Aun no tienes una cuanta? Crear una</a>
    <a href="/olvide">¿Olvidaste tu Contraseña?</a>
</div>