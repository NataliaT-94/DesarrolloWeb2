<?php 

    require '../../includes/app.php';

    use App\Vendedor;

    estaAutenticado();

    $vendedor = new Vendedor;

    //Array con mensajes de errores
    // $errores = [];
    $errores = Vendedor::getErrores();


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //Crear una nueva instancia
        $vendedor = new Vendedor($_POST['vendedor']);

        //Validar que no haya campos vacios
        $errores = $vendedor -> validar();

        //No hay errores
        if(empty($errores)){
            $vendedor -> guardar();
        }
    }
    
    incluirTemplate('header');

?>
    
<main class="contenedor seccion">
    <h1>Registrar Vendedor(a)</h1> 

    <a href="http://localhost/GitHub/DesarrolloWeb2/bienesraices_inicio/admin/" class="boton boton-verde">Volver</a>

    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>

    <?php endforeach; ?>

    <form class="formulario" method="POST" action="http://localhost/GitHub/DesarrolloWeb2/bienesraices_inicio/admin/vendedores/crear.php">
        <!-- GET: guarda la informacion en la URL, se comunica con el name: titulo// no es recomendable para mandar datos a un servidor, porque expone los datos en la URL -->
        <!-- POST: maneja internamente en el archivo, se comunica con el name: titulo // envia datos de forma segura -->
        <?php include '../../includes/templates/formulario_vendedores.php'; ?>

        <input type="submit" value="Registrar Vendedor(a)" class="boton boton-verde">
    </form>

</main>

<?php 
    incluirTemplate('footer' );
?>