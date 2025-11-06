<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UpTask | <?php echo $titulo ?? ''; ?></title>

    <?php
        // Aseguramos que $basePath siempre tenga un valor válido
        // Si no se define en el controlador, usa BASE_URL como respaldo
        $basePath = $basePath ?? (defined('BASE_URL') ? BASE_URL : '/');
    ?>

    <base href="<?= $basePath ?>">
    <script>window.APP_BASE = "<?= $basePath ?>";</script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet"></head>
    <link rel="stylesheet" href="build/css/app.css">
    <meta name="app-base" content="<?php echo $assetBase; ?>">

</head>
    
<body>

    <?php echo $contenido; ?>


    <?php
        echo $script ?? '';
    ?>
</body>
</html>