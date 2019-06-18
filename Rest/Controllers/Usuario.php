<?php
    require 'Models/UsuarioModel.php';
    class Usuario {

        private $userModel;
        public function get($parametros){
            //echo var_dump($parametros);
            $this->userModel = new UsuarioModel();
            if(!empty($parametros[0])){
                switch($parametros[0]){

                    case 'getAllUsuario':
                        return $this->userModel->getAllUsuario();
                    break;


                    default:
                        return [ "error"=>"No hay parámetros para buscar una solicitud"];
                    break;
                }



        }
    }

    public function post($parametros){
        $this->userModel = new UsuarioModel();
        // Se obtiene el JSON
        $cuerpo = file_get_contents('php://input');
        //Se decodifica el JSON para volverlo como una arreglo
        $array = json_decode($cuerpo);
        //echo $array['user'];
        //Se busca el recurso pedido por el usuario

        switch($parametros[0]){
/*
            case 'getUsuarioById'
            return $this->userModel->getUsuarioById($array);
            break;*/

            case 'insertUsuario':
            return $this->userModel->insertUsuario($array);
            break;

            case 'updateUsuario':
            return $this->userModel->updateUsuario($array);
            break;

            case 'deleteUsuario':
            return $this->userModel->deleteUsuario($array);
            break;


            default:
            echo 'Error';
            break;

        }
    }

 }

?>
