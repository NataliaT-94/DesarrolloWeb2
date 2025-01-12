<h1 class="nombre-pagina">Panel de Administracion</h1>

<?php
    include_once __DIR__ . '/../templates/barra.php';
?>
<h2>Buscar Citas</h2>
<div class="busqueda">
    <form class="formulario">

        <div class="campo">
            <label for="fecha">Fecha</label>
            <input type="date" name="fecha" id="fecha" value="<?php echo $fecha; ?>" />
        </div>

    </form>
</div>

<div id="citas-admin">
    <ul class="citas">

        <?php
            $idCita = 0;
            foreach($citas as $key=>$cita){//$key es la posocion que tiene el registro en el arreglo
                if($idCita !== $cita->id){
                    $total = 0; 
        ?>  
        <li>
            <p>ID: <span><?php echo $cita->id; ?></span></p>
            <p>Hora: <span><?php echo $cita->hora; ?></span></p>
            <p>Cliente: <span><?php echo $cita->cliente; ?></span></p>
            <p>Email: <span><?php echo $cita->email; ?></span></p>
            <p>Telefono: <span><?php echo $cita->telefono; ?></span></p>

            <h3>Servicios</h3>

            <?php 
                $idCita = $cita->id;
                } //Fin del IF 
                $total += $cita->precio;
            ?>

            <p class="servicio"><?php echo $cita->servicio . " " . $cita->precio; ?></p>
        <?php
            $actual = $cita->id;//retorna el id en el cual nos encontramos
            $proximo = $citas[$key + 1]->id ?? 0;//es el indice en la base de datos
        
            if(esUltimo($actual, $proximo)){
        ?>
                <p class="total">Total:  <span>$ <?php echo $total; ?></span> </p>
        <?php
            }
        ?>
        
        <?php   
            } //Fin del Foreach 
        ?>
    </ul>
</div>
<?php
    $script = "<script src='build/js/bundle.js'></script";
?>