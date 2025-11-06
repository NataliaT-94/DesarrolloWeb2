<main class="registro">
    <h2 class="registro__heading"><?php echo $titulo; ?></h2>
    <p class="registro__descripcion">Tu Boleto - Te recomendamos almacenarlo, puedes compartirlo en redes sociales</p>

    <div class="boleto boleto--<?php echo strtolower($paquete->nombre); ?> boleto--acceso">
        <div class="boleto__contenido">
            <h4 class="boleto__logo">&#60;DevWebCamp /></h4>
            <p class="boleto__plan"><?php echo $paquete->nombre; ?></p>
            <p class="boleto__nombre"><?php echo $usuario->nombre . " " . $usuario->apellido; ?></p>
        </div>
        
        <p class="boleto__codigo"><?php echo '#' . $registro->token; ?></p>
    </div>
</main>