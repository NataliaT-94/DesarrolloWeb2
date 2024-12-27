    <main class="contenedor seccion">
    <h1>Administrador de Automotores</h1>
    <?php 
        if($resultado){
            $mensaje = mostrarNotificacion(intval($resultado));
            if($mensaje){  ?>
                <p class="alerta exito"><?php echo s($mensaje); ?></p>
            <?php }?>
        <?php }?>


    <a href="/vehiculos/crear" class="boton boton-verde">Nuevo Vehiculo</a>
    <a href="/vendedores/crear" class="boton boton-amarillo">Nuevo(a) Vendedor</a>

    <h2>Vehiculos</h2>
    <table class="vehiculos">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody><!--- Mostrar los Resultados -->
            <?php foreach( $vehiculos as $vehiculo): ?>
            <tr>
                <td><?php echo $vehiculo->id; ?></td>
                <td><?php echo $vehiculo->titulo; ?></td>
                <td><img src="/imagenes/<?php echo $vehiculo->imagen; ?>" class="imagen-tabla"></td>
                <td>$<?php echo $vehiculo->precio; ?></td>
                <td>
                    <form method="POST" action="vehiculos/eliminar" class="w-100">
                        <input type="hidden" name="id" value="<?php echo $vehiculo->id; ?>"><!--//sirve paa eviar la info del id que se elimino -->
                        <input type="hidden" name="tipo" value="vehiculo">
                        <input type="submit" class="boton-rojo-block" value="Eliminar">
                    </form>
                    <a href="/vehiculos/actualizar?id=<?php echo $vehiculo->id; ?>" class="boton-amarillo-block">Actualizar</a>

                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Vendedores</h2>
        <table class="vehiculos">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody><!--- Mostrar los Resultados -->
                <?php foreach( $vendedores as $vendedor): ?>
                <tr>
                    <td><?php echo $vendedor->id; ?></td>
                    <td><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></td>
                    <td><?php echo $vendedor->telefono; ?></td>
                    <td>
                        <form method="POST" class="w-100" action="/vendedores/eliminar">
                            <input type="hidden" name="id" value="<?php echo $vendedor -> id; ?>"><!--//sirve paa eviar la info del id que se elimino -->
                            <input type="hidden" name="tipo" value="vendedor">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>

                        <a href="/vendedores/actualizar?id=<?php echo $vendedor -> id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
</main>

