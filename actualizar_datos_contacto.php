<?php


require 'EveryWhere.php';
           

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $body = json_decode(file_get_contents("php://input"), true);

    // Se obtienen los parametros enviados desde la aplicación.
    $email = $body['email'];
    $idUsuario = $body['idUsuario'];  
    $nombreContacto = $body['nombreContacto'];   
    $numeroMovil = $body['numeroMovil'];               

        // Insertar datos de contacto
        $retorno = Meta::actualizarDatosContacto($idUsuario,$nombreContacto,$email,$numeroMovil)  ;

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