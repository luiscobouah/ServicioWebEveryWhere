<?php

require 'EveryWhere.php';
           

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $body = json_decode(file_get_contents("php://input"), true);

    // Se obtienen los parametros enviados desde la aplicaci´on.
    $email = $body['email'];
    $contrasena = $body['contrasena'];
    $nombre =$body['nombre'];

        // Insertamos el usuario
        $retorno = Meta::insertarUsuario($email,$contrasena,$nombre)  ;

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