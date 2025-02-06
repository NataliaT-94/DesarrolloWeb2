<main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Secion</h1>

        <?php
            include_once __DIR__ . "/../templates/alertas.php";
        ?>


        <form method="POST" class="formulario" action="/login">
            <fieldset>
                <legend>Email y Password</legend>

                <label for="email">E-mail</label>
                <input type="email" name="email" placeholder="Tu Email" id="email" >

                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Tu password" id="password" >

            </fieldset>
            <input type="submit" value="Iniciar Sesion" class="boton boton-verde">
        </form>
        <div class="acciones">
            <a href="/crear-cuenta">¿Aun no tienes una cuanta? Crear una</a>
            <a href="/olvide">¿Olvidaste tu Contraseña?</a>
        </div>
    </main>