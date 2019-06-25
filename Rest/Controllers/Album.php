<?php
require 'Models/AlbumModel.php';
class Album {

  private $albumModel;

  public function get($parametros){
    //echo var_dump($parametros);
    $this->albumModel = new AlbumModel();
    if(!empty($parametros[0])){
      switch($parametros[0]){

        case 'getAllAlbum':
        return $this->albumModel->getAllAlbum();
        break;

        default:
        return [ "error"=>"No hay parámetros para buscar una solicitud"];
        break;
      }
    }
  }

  public function post($parametros){
    $this->albumModel = new AlbumModel();
    // Se obtiene el JSON
    $cuerpo = file_get_contents('php://input');
    //Se decodifica el JSON para volverlo como una arreglo
    $array = json_decode($cuerpo);
    //echo $array['user'];
    //Se busca el recurso pedido por el usuario

    switch($parametros[0]){
      case 'insertAbum':
      return $this->albumModel->insertAlbum($array);
      break;

      case 'updateAlbum':
      return $this->albumModel->updateAlbum($array);
      break;

      case 'deleteAlbum':
      return $this->albumModel->deleteAlbum($array);
      break;


      default:
      echo 'Error';
      break;
    }
  }
}
?>
