<?php
require 'Models/ArtistaModel.php';
class Artista {

  private $artistaModel;

  public function get($parametros){
    //echo var_dump($parametros);
    $this->artistaModel = new ArtistaModel();
    if(!empty($parametros[0])){
      switch($parametros[0]){

        case 'getAllArtista':
        return $this->artistaModel->getAllArtista();
        break;

        default:
        return [ "error"=>"No hay parámetros para buscar una solicitud"];
        break;
      }
    }
  }

  public function post($parametros){
    $this->artistaModel = new ArtistaModel();
    // Se obtiene el JSON
    $cuerpo = file_get_contents('php://input');
    //Se decodifica el JSON para volverlo como una arreglo
    $array = json_decode($cuerpo);
    //echo $array['user'];
    //Se busca el recurso pedido por el usuario

    switch($parametros[0]){
      case 'insertArtista':
      return $this->artistaModel->insertArtista($array);
      break;

      case 'updateArtista':
      return $this->artistaModel->updateArtista($array);
      break;

      case 'deleteArtista':
      return $this->artistaModel->deleteArtista($array);
      break;


      default:
      echo 'Error';
      break;
    }
  }
}
?>
