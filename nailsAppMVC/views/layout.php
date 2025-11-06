<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nails App MVC</title>

    <!-- Base para que las rutas relativas cuelguen de /dev/nailsAppMVC/public/ -->
    <!-- <base href="<?php //echo $assetBase; ?>"> -->
    <base href="<?= $basePath ?>">
    <script>window.APP_BASE = "<?= $basePath ?>";</script>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;500;700;900&family=Playfair+Display:wght@400;700;900&family=Roboto:wght@300;400;700;900&display=swap" rel="stylesheet">

    <!-- OJO: ruta RELATIVA (gracias al <base>) -->
    <link rel="stylesheet" href="build/css/app.css">
    <!-- Expongo base para JS por si hace falta -->
    <meta name="app-base" content="<?php echo $assetBase; ?>">
</head>
<body>
    <div class="contenedor-app">
        <div class="imagen"></div>
        <div class="app">
            <?php echo $contenido; ?>
        </div>
    </div>

<?= $script ?? '' ?>

</body>
</html>
