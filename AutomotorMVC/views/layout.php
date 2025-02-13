<?php 
if(!isset($_SESSION)){
    session_start();
}

$auth = $_SESSION['login'] ?? false;

if(!isset($inicio)){
    $inicio = false;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/build/css/app.css">
    
    <title>Automotor</title>
</head>
<body>
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    <img src="./build/img/logo-novo-fiat.svg" alt="logotipo de automotor">
                </a>

                <div class="mobile-menu">
                    <img src="./build/img/barras.svg" alt="icono menu responsive">
                </div>

                <div class="derecha">
                    <img class="dark-mode-boton" src="./build/img/dark-mode.svg">
                    <nav class="navegacion">
                        <a href="/nosotros">Nosotros</a>
                        <a href="/vehiculos">Anuncios</a>
                        <a href="/blog">Blog</a>
                        <a href="/contacto">Contacto</a>
                        <?php if($auth){?>
                            <a href="/logout">Cerrar Sesion</a>
                        <?php } else { ?>
                            <a href="/login">Iniciar Sesion</a>
                        <?php } ?>
                    </nav>
                </div>
  
            </div><!----  .barra  ---->
            <?php  echo $inicio ? "<h1>Venta de Vehiculos 0KM</h1>" : ''; ?>

        </div>
    </header>

    <?php echo $contenido;  ?>
    
    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion">
                <a href="/nosotros">Nosotros</a>
                <a href="/vehiculos">Anuncios</a>
                <a href="/blog">Blog</a>
                <a href="/contacto">Contacto</a>
            </nav>
        </div>
        <p class="copyright">Todos los derechos Reservados <?php echo date('Y'); ?> &copy;</p>
    </footer>

    <script src="/build/js/bundle.js"></script>
</body>
</html>Z