<?php 

function obtener_servicios(){
    try{
        ///para consultar una base de datos hay que realizar estos 4 pasos
        // Importar las credenciales
        require 'database.php';

        // Consulta SQL
        $sql = "SELECT * FROM servicios;";

        // Realizar la consulta
        $consulta = mysqli_query($db, $sql);//primer parametro base de datos, segundo lo que quieres obtener
        
        return $consulta;
        /** 
        // Acceder a los resultados
        echo "<pre>";
        var_dump(mysqli_fetch_assoc($consulta));//fetch sirve para acceder a una consulta que se realizo previamente
        echo "<pre>";
        
        // Cerrar la conexion (opcional)
        $resultado = mysqli_close($db); //hay que pasarle la base de datos que va a cerrar
        echo $resultado;// si aparese un 1 en la ventana significa que se realico correctamente
        */
    }catch(\Throwable $th){//sirve para visualizar el error
        var_dump($th);
    }
}

obtener_servicios();