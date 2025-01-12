<?php

namespace Controllers;

use Model\Cita;
use Model\CitaServicio;
use Model\Servicio;

class APIController{
    public static function index(){
       $servicios = Servicio::all();

    //    debuguear($servicios);
       echo json_encode($servicios);
    }

    public static function guardar(){
      // $respuesta = [
      //    'datos' => $_POST
      // ];

      //Almacena la Cita y devuelve el ID
      $cita = new Cita($_POST);
      $resultado = $cita->guardar();

      $id = $resultado['id'];

      // $respuesta = [
      //    'cita' => $cita
      // ];

      //Almacena la Cita y el Servicio

      //Almacena los Servicios con el Id de la Cita
      $idDervicios = explode(",", $_POST['servicios']);//toma como referencia la coma como separador
      
      foreach($idDervicios as $idServicio){
         $args = [
            'citaId' => $id,
            'servicioId' => $idServicio
         ];
         $citaServicio = new CitaServicio($args);
         $citaServicio->guardar();
      }

      echo json_encode(['resultado' => $resultado]);
    }

    public static function eliminar(){
      if($_SERVER['REQUEST_METHOD'] === 'POST'){
          $id = $_POST['id'];//leemos el id
          $cita = Cita::find($id);//lo encontramos
          $cita->eliminar();//lo eliminamos
          header('Location:' . $_SERVER['HTTP_REFERER']);//Recargamos la pagina actual
      }
  }
}