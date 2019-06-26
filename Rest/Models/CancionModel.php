<?php
require_once('core/db_abstract_model.php');
class CancionModel extends DBAbstractModel{

  public function __construct() {}

    /************************
    GET Cancion
    *************************/

    public function getAllCancion(){
      $this->query="SELECT * FROM Cancion";
      $this->get_results_from_query();
      if(count($this->rows) > 0){
        return [
          "datos"=>$this->rows
        ];
      }
    }

    function insertCancion($array){
      if(!empty($array)){
        $consulta = "INSERT INTO `Cancion` (`ID_Cancion`,`NombreCancion`, `DuracionCancion`,`UrlSong`,`ID_Album`)
        VALUES (
          '$array->ID_Cancion',
          '$array->NombreCancion',
          '$array->DuracionCancion',
          '$array->UrlSong',
          '$array->ID_Album');";
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

      function updateCancion($array){
        if(!empty($array)){
          $consulta = "UPDATE Cancion
          SET Cancion.NombreCancion = '$array->NombreCancion',
          Cancion.DuracionCancion = '$array->DuracionCancion',
          Cancion.UrlSong = '$array->UrlSong',
          Cancion.ID_Album = '$array->ID_Album'
          WHERE  Cancion.ID_Cancion = $array->ID_Cancion";
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

      function deleteCancion($array){
        if(!empty($array)){
          $consulta = "DELETE FROM `Cancion`
          WHERE Cancion.ID_Cancion = $array->ID_Cancion";
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
