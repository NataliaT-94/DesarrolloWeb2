<div class="contenedor reestablecer">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php' ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Coloca tu nuevo Password</p>

        <form class="formulario" method="POST" action="/reestablecer">
            <div class="campo">
                <label for="password">Password</label>
                <input type="password" id="password" placeholder="Tu Password" name="password">
            </div>

            <input type="submit" class="boton" value="Guardar Password">
        </form>

        <div class="acciones">
            <a href="/crear">Crear una Cuenta</a>
            <a href="/olvide">Olvide mi Contraseña</a>
        </div>
    </div><!-- .contenedor-sm --->
</div>