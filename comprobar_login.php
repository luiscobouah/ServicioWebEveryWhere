<?php


require 'EveryWhere.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $body = json_decode(file_get_contents("php://input"), true);

    // Se obtienen los parametros enviados desde la aplicación.   
    $email = $body['email'];
    $contrasena = $body['contrasena'];   


    // se obtiene un array con los datos del usuario donde viene incluida la contraseña
    $arrayContrasena = Meta::obtenerContrasena($email);


    if ($arrayContrasena) {

         //se obtiene la contrasena en Hash del array obtenido anteriormente.
         $contrasenaHash= $arrayContrasena['CONTRASENA'];

        //se verifica que la contraseña introducida por el usuario coincide con la contraseña almacenada.
        if (password_verify($contrasena,$contrasenaHash)) {  

         print json_encode(
            array(
                'estado' => '1',
                'mensaje' => 'Correcto'
            )
        );

        }  

        else   {
        // Enviar respuesta de error general
        print json_encode(
            array(
                'estado' => '2',
                'mensaje' => 'Error'
            )
        );
    }       


    } else {
        // Enviar respuesta de error general
        print json_encode(
            array(
                'estado' => '3',
                'mensaje' => 'Contraseña o usuario incorrecto'
            )
        );
    }      
}


?>
