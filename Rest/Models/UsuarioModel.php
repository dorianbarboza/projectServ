<?php
    require_once('core/db_abstract_model.php');
    class UsuarioModel extends DBAbstractModel{

        public function __construct(){

        }

        /************************
          GET Usuarios
        *************************/

        public function getAllUsuario(){
            $this->query="SELECT * FROM Usuario";
            $this->get_results_from_query();
            if(count($this->rows) > 0){

                return [
                    "datos"=>$this->rows

                ];
            }
        }

        function getUsuarioById($array){
            if(!empty($array)){
                $consulta = "SELECT * FROM Usuario
                             WHERE  Usuario.ID_Usuario = $array->ID_Usuario";
            }
            $this->query = $consulta;
            // Ejecutar sentencia preparada
            $result = $this->execute_single_query();
                if ($result['mensaje'] == "Buscado"){
                    return [
                        "datos" =>"Buscado"
                    ];

            }else{
                return [
                    "error"=>"Error en el JSON"
                ];
            }
    }

        function insertUsuario($array){
            if(!empty($array)){
                $consulta = "INSERT INTO `Usuario` (`Username`, `Password`)
                 VALUES (
                     '$array->Username',
                      '$array->Password');";
            }
            $this->query = $consulta;
            // Ejecutar sentencia preparada
            $result = $this->execute_single_query();
                if ($result['mensaje'] == "Registrado"){
                    return [
                        "datos" =>"Se ha registrado el usuario"
                    ];

            }else{
                return [
                    "error"=>"Error en el JSON"
                ];
            }
    }



    function updateUsuario($array){
        if(!empty($array)){
            $consulta = "UPDATE Usuario
                SET Usuario.Username = '$array->Username',
                    Usuario.Password = '$array->Password'
                WHERE  Usuario.ID_Usuario = $array->ID_Usuario";

        }

        //echo $consulta;
        $this->query = $consulta;
        // Ejecutar sentencia preparada
        $result = $this->execute_single_query();
        if ($result['mensaje'] == "Registrado"){
                return [
                    "datos" =>"Registro actualizado"
                ];

        }else{
            return [
                "error"=>"Error en el JSON2"
            ];
        }
    }


    function deleteUsuario($array){
        if(!empty($array)){
            $consulta = "DELETE FROM `Usuario`
            WHERE Usuario.ID_Usuario = $array->ID_Usuario";
        }

           //echo $consulta;
           $this->query = $consulta;
           // Ejecutar sentencia preparada
           $result = $this->execute_single_query();
           if ($result['mensaje'] == "Registrado"){
                   return [
                       "datos" =>"Registro eliminado"
                   ];

           }else{
               return [
                   "error"=>"Error en el JSON2"
               ];
           }
    }

    }

?>
