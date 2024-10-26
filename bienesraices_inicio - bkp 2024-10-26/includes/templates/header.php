<?php 

    if(!isset($_SESSION)){
        session_start();
    }

    //var_dump($_SESSION);

    $auth = $_SESSION['login'] ?? false;

    //var_dump($auth);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/GitHub/DesarrolloWeb2/bienesraices_inicio/build/css/app.css">
    
    <title>Bienes Raices</title>
</head>
<body>
    <header class="header <?php echo $inicio ? 'inicio' : '' ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="index.php">
                    <img src="http://localhost/GitHub/DesarrolloWeb2/bienesraices_inicio/build/img/logo.svg" alt="logotipo de bienes Raices">
                </a>

                <div class="mobile-menu">
                    <img src="http://localhost/GitHub/DesarrolloWeb2/bienesraices_inicio/build/img/barras.avif" alt="icono menu responsive">
                </div>

                <div class="derecha">
                    <img class="dark-mode-boton" src="http://localhost/GitHub/DesarrolloWeb2/bienesraices_inicio/build/img/dark-mode.svg">
                    <nav class="navegacion">
                        <a href="nosotros.php">Nosotros</a>
                        <a href="anuncios.php">Anuncios</a>
                        <a href="blog.php">Blog</a>
                        <a href="contacto.php">Contacto</a>
                        <?php if($auth): ?>
                            <a href="../cerrar-sesion.php">Cerrar Sesion</a>
                        <?php endif; ?>
                    </nav>
                </div>
  
            </div><!----  .barra  ---->

            <?php if($inicio){ ?>
                <h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>
            <?php } ?>
        </div>
    </header>