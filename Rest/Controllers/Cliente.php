<?php
require 'Models/ClienteModel.php';
class Cliente {

  private $clienteModel;

  // URL: http://localhost/projectWeb/api.mvc/Cliente/getCliente/

  public function get($parametros){
  //echo var_dump($parametros);
  $this->clienteModel = new ClienteModel();
  if(!empty($parametros[0])){
    switch($parametros[0]){
      case 'getCliente':
      return $this->clienteModel->getCliente();
      break;

      default:
      return [ "error"=>"No hay parámetros para buscar una solicitud"];
      break;
    }
  }
}

  // URL: http://localhost/projectWeb/api.mvc/Cliente/RECURSO/

public function post($parametros){
  $this->clienteModel = new ClienteModel();
  /* Se obtiene el JSON */
  $cuerpo = file_get_contents('php://input');
  //Se decodifica el JSON para volverlo como una arreglo
  $array = json_decode($cuerpo);
  //echo $array['user'];
  //Se busca el recurso pedido por el usuario
  switch($parametros[0]){

    case 'insertarCliente':
    return $this->clienteModel->agregarCliente($array);
    break;

    case 'actualizarCliente':
    return $this->clienteModel->actualizarCliente($array);
    break;
    case 'eliminarCliente':
    return $this->clienteModel->eliminarCliente($array);
    break;

    default:
    echo 'Error';
    break;
  }
}
}
?>
