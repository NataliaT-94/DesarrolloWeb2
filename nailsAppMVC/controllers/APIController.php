<?php

namespace Controllers;

use Model\Cita;
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
      
      $cita = new Cita($_POST);
      $resultado = $cita->guardar();

      // $respuesta = [
      //    'cita' => $cita
      // ];

      echo json_encode($resultado);
    }
}