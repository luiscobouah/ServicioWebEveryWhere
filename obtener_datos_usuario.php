<?php


require 'EveryWhere.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $body = json_decode(file_get_contents("php://input"), true);

    // Se obtienen los parametros enviados desde la aplicación.
    $email = $body['email'];                

    // obtener datos de usuario.
    $retorno = Meta::obtenerDatosUsuario($email);


    if ($retorno) {

        $meta["estado"] = "1";
        $meta["usuario"] = $retorno;
        // Enviar objeto json con los datos de usuario
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

