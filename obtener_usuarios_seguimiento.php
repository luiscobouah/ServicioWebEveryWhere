<?php


require 'EveryWhere.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {      

   $body = json_decode(file_get_contents("php://input"), true);

   // Se obtienen el parametro enviado desde la aplicación.
   $email = $body['email'];      

    // se obtiene un array con los usuarios en seguimiento
    $retorno = Meta::obtenerUsuariosSeguimiento($email);


    if ($retorno) {

        $meta["estado"] = "1";
        $meta["usuarios"] = $retorno;
        // Enviar objeto json de usuarios en seguimiento
        print json_encode($meta);

    } else {
        // Enviar respuesta de error general
        print json_encode(
            array(
                'estado' => '2',
                'mensaje' => 'No se obtuvo el registro'
            )
        );
    }

}             
               
       
?>

