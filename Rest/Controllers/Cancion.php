<?php
require 'Models/CancionModel.php';
class Cancion {

  private $cancionModel;

  public function get($parametros){
    //echo var_dump($parametros);
    $this->cancionModel = new CancionModel();
    if(!empty($parametros[0])){
      switch($parametros[0]){

        case 'getAllCancion':
        return $this->cancionModel->getAllCancion();
        break;

        default:
        return [ "error"=>"No hay parámetros para buscar una solicitud"];
        break;
      }
    }
  }

  public function post($parametros){
    $this->cancionModel = new CancionModel();
    // Se obtiene el JSON
    $cuerpo = file_get_contents('php://input');
    //Se decodifica el JSON para volverlo como una arreglo
    $array = json_decode($cuerpo);
    //echo $array['user'];
    //Se busca el recurso pedido por el usuario

    switch($parametros[0]){
      case 'insertCancion':
      return $this->cancionModel->insertCancion($array);
      break;

      case 'updateCancion':
      return $this->cancionModel->updateCancion($array);
      break;

      case 'deleteCancion':
      return $this->cancionModel->deleteCancion($array);
      break;


      default:
      echo 'Error';
      break;
    }
  }
}
?>
