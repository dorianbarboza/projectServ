<?php
require_once('core/db_abstract_model.php');
class AlbumModel extends DBAbstractModel{

  public function __construct() {}

    /************************
    GET Album
    *************************/

    public function getAllAlbum(){
      $this->query="SELECT * FROM Album";
      $this->get_results_from_query();
      if(count($this->rows) > 0){
        return [
          "datos"=>$this->rows
        ];
      }
    }

    function insertAlbum($array){
      if(!empty($array)){
        $consulta = "INSERT INTO `Album` (`ID_Album`,`NombreAlbum`, `Publicacion`,`CiudadGrabacion`,`PaisGrabacion`,`Duracion`,`Genero`,`UrlImgAlbum`,`ID_Artista`)
        VALUES (
          '$array->ID_Album',
          '$array->NombreAlbum',
          '$array->Publicacion',
          '$array->CiudadGrabacion',
          '$array->PaisGrabacion',
          '$array->Duracion',
          '$array->Genero',
          '$array->UrlImgAlbum',
          '$array->ID_Artista');";
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

      function updateAlbum($array){
        if(!empty($array)){
          $consulta = "UPDATE Album
          SET Album.NombreAlbum = '$array->NombreAlbum',
          Album.Publicacion = '$array->Publicacion',
          Album.CiudadGrabacion = '$array->CiudadGrabacion',
          Album.PaisGrabacion = '$array->PaisGrabacion',
          Album.Duracion = '$array->Duracion',
          Album.Genero = '$array->Genero',
          Album.UrlImgAlbum = '$array->UrlImgAlbum',
          Album.ID_Artista = '$array->ID_Artista'
          WHERE  Album.ID_Album = $array->ID_Album";
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

      function deleteAlbum($array){
        if(!empty($array)){
          $consulta = "DELETE FROM `Album`
          WHERE Album.ID_Album = $array->ID_Album";
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
