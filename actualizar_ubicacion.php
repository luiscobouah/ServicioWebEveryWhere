<?php


require 'EveryWhere.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $body = json_decode(file_get_contents("php://input"), true);

    // Se obtienen los parametros enviados desde la aplicación.
    $idUsuario = $body['idUsuario'];
    $latitud = $body['latitud'];
    $longitud = $body['longitud'];
    $direccion = $body['direccion'];
    $ciudad = $body['ciudad'];
  
    // Actualizar ubicacion de un usuario.
    $retorno = Meta::actualizarUbicacion($idUsuario,$latitud,$longitud,$direccion,$ciudad);

    if ($retorno) {
        // Código de éxito
        print json_encode(
            array(
                'estado' => '1',
                'mensaje' => 'Creación éxitosa')
        );
    } else {
        // Código de falla
        print json_encode(
            array(
                'estado' => '2',
                'mensaje' => 'Error')
        );
    }   

 }        
       
    
?>
