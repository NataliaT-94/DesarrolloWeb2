<div class="contenedor olvide">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php'; ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Recuperar tu Cuenta</p>

        <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

        <form class="formulario" method="POST" action="olvide" novalidate>
            <div class="campo">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Tu Email" name="email" >
            </div>

            <input type="submit" class="boton" value="enviar Instrucciones">
        </form>

        <div class="acciones">
            <a href="">Si ya tienes cuenta, Inicia Sesion</a>
            <a href="crear">Crear una Cuenta</a>
        </div>
    </div><!-- .contenedor-sm --->
</div>