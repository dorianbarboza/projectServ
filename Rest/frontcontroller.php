<?php
/**
 * Created by PhpStorm.
 * User: agesquivel
 * Date: 2019-04-04
 * Time: 12:54
 */

require 'Controllers/Usuario.php';
require 'Controllers/Cliente.php';
require 'core/ExcepcionApi.php';
require 'core/VistaApi.php';
require 'core/VistaJson.php';
require 'core/VistaXML.php';

// Constantes de estado
const ESTADO_URL_INCORRECTA = 2;
const ESTADO_EXISTENCIA_RECURSO = 3;
const ESTADO_METODO_NO_PERMITIDO = 4;

//Validar si se llama para devolver datos en formato xml o json
$formato = isset($_GET['formato']) ? $_GET['formato'] : 'json';

switch ($formato) {
    case 'xml':
        $vista = new VistaXML();
        break;
    case 'json':
    default:
        $vista = new VistaJson();
}

// Extraer segmento de la url
if (isset($_GET['PATH_INFO']))
    $peticion = explode('/', $_GET['PATH_INFO']);//localhost/api.people.com/v1/usuario/getall
else
    throw new ExcepcionApi(ESTADO_URL_INCORRECTA, utf8_encode("No se reconoce la petición"));

$recurso = array_shift($peticion);//

//echo $recurso;

$recursos_existentes = array('Usuario','Cliente'); //Se ponen en singular


// Comprobar si existe el recurso
if (!in_array($recurso, $recursos_existentes)) {
    throw new ExcepcionApi(ESTADO_EXISTENCIA_RECURSO,
        "No se reconoce el recurso al que intentas acceder");
}

$metodo = strtolower($_SERVER['REQUEST_METHOD']);

// Filtrar método
switch ($metodo) {
    case 'get':
    case 'post':
    case 'put':
    case 'delete':
        if (method_exists($recurso, $metodo)) {
            /*$usuario = new Usuario();
            $respuesta = $usuario -> get($peticion);
            echo var_dump($respuesta);*/

            $respuesta = call_user_func(array(new $recurso, $metodo), $peticion);
            $vista->imprimir($respuesta);
            break;
            //echo 'existe';
        }
    default:
        // Método no aceptado
        $vista->estado = 405;
        $cuerpo = [
            "estado" => ESTADO_METODO_NO_PERMITIDO,
            "mensaje" => utf8_encode("Método no permitido")
        ];
        $vista->imprimir($cuerpo);
}
?>
