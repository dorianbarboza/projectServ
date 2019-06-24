<?php
require_once('core/db_abstract_model.php');
class ArtistaModel extends DBAbstractModel{

  public function __construct() {}

    /************************
    GET Usuarios
    *************************/

    public function getAllArtista(){
      $this->query="SELECT * FROM Artista";
      $this->get_results_from_query();
      if(count($this->rows) > 0){
        return [
          "datos"=>$this->rows
        ];
      }
    }

    function insertArtista($array){
      if(!empty($array)){
        $consulta = "INSERT INTO `Artista` (`ID_Artista`,`Seudonimo`, `Nombre`,`Apellido`,`FechaNacimiento`,`Ciudad`,`Pais`,`UrlImg`)
        VALUES (
          '$array->ID_Artista',
          '$array->Seudonimo',
          '$array->Nombre',
          '$array->Apellido',
          '$array->FechaNacimiento',
          '$array->Ciudad',
          '$array->Pais',
          '$array->UrlImg');";
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

      function updateArtista($array){
        if(!empty($array)){
          $consulta = "UPDATE Artista
          SET Artista.Seudonimo = '$array->Seudonimo',
          Artista.Nombre = '$array->Nombre',
          Artista.Apellido = '$array->Apellido',
          Artista.FechaNacimiento = '$array->FechaNacimiento',
          Artista.Ciudad = '$array->Ciudad',
          Artista.Pais = '$array->Pais',
          Artista.UrlImg = '$array->UrlImg'
          WHERE  Artista.ID_Artista = $array->ID_Artista";
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

      function deleteArtista($array){
        if(!empty($array)){
          $consulta = "DELETE FROM `Artista`
          WHERE Artista.ID_Artista = $array->ID_Artista";
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
