<?php
    require_once('core/db_abstract_model.php');
    class ClienteModel extends DBAbstractModel{

        public function __construct(){

        }

        /************
          GET Cliente
        *************/
        public function getCliente(){
            $this->query="SELECT * FROM Cliente";
            $this->get_results_from_query();
            if(count($this->rows) > 0){

                return [
                    "datos"=>$this->rows

                ];
            }
        }

        /********************
          POST INSERT Cliente
        *********************/

            function agregarCliente($array){
                if(!empty($array)){
                    $consulta = "INSERT INTO `Cliente` (`Username`, `Password`, `Correo`,`Telefono`, `Nombre`,`Apellidos`,`FechaNacimiento`,`Ciudad`,`Sexo`)
                     VALUES (
                         '$array->Username',
                          '$array->Password',
                          '$array->Correo',
                          '$array->Telefono',
                          '$array->Nombre',
                          '$array->Apellidos',
                          '$array->FechaNacimiento',
                          '$array->Ciudad',
                          '$array->Sexo');";


                }
                $this->query = $consulta;
                // Ejecutar sentencia preparada
                $result = $this->execute_single_query();
                    if ($result['mensaje'] == "Registrado"){
                        return [
                            "datos" =>"Se ha registrado"
                        ];

                }else{
                    return [
                        "error"=>"Error en el JSON"
                    ];
                }
        }

        /********************
          POST UPDATE Cliente
        *********************/

        function actualizarCliente($array){
          if(!empty($array)){
            $consulta = "UPDATE Cliente
            SET Cliente.Username = '$array->Username',
                Cliente.Password = '$array->Password',
                Cliente.Correo = '$array->Correo',
                Cliente.Telefono = '$array->Telefono',
                Cliente.Nombre = '$array->Nombre',
                Cliente.Apellidos = '$array->Apellidos',
                Cliente.FechaNacimiento = '$array->FechaNacimiento',
                Cliente.Ciudad = '$array->Ciudad',
                Cliente.Sexo = '$array->Sexo'
            WHERE  Cliente.ID_Cliente = $array->ID_Cliente";
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

        /********************
          POST DELETE Cliente
        *********************/

        function eliminarCliente($array){
            if(!empty($array)){
                $consulta = "DELETE FROM `Cliente`
                WHERE Cliente.ID_Cliente = $array->ID_Cliente";
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
