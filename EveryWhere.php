<?php

require 'Database.php';
//require 'password.php'; // se utiliza para solucionar problema al encriptar contraseña en php 5.3.3

class Meta
{
    function __construct()
    {
    }

    /**
     * Obtener contraseña de un usuario.
     *
     * @param $email      email del usuario 
     * @return array Datos del registro(CONTRASENA)
     */

    public static function obtenerContrasena($email)  

    {
        $consulta = "SELECT CONTRASENA FROM USUARIO WHERE EMAIL='$email'";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();

            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;



        } catch (PDOException $e) {
            return false;
        }
    }  

    /**
     * Obtener usuarios en seguimiento.
     *
     * @param $email      email del usuario 
     * @return array Datos del registro(NOMBRE,LATITUD,LONGITUD,DIRECCION,CIUDAD,HORA_ACTUALIZACION)
     */

    public static function obtenerUsuariosSeguimiento($email) 
     {
   
       $consulta= "SELECT NOMBRE,LATITUD,LONGITUD,DIRECCION,CIUDAD,HORA_ACTUALIZACION 
       FROM USUARIO_CONTACTO INNER join UBICACION on USUARIO_CONTACTO.USUARIO_ID_USUARIO=UBICACION.USUARIO_ID_USUARIO
        INNER  join USUARIO ON UBICACION.USUARIO_ID_USUARIO=USUARIO.ID_USUARIO WHERE EMAIL_CONTACTO = ?";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($email));
            // Capturar primera fila del resultado
            $row = $comando->fetchAll(PDO::FETCH_ASSOC);
            return $row;

        } catch (PDOException $e) {
           
            return -1;
        }
    } 

    /**
     * Obtener datos usuario.
     *
     * @param $email      email del usuario 
     * @return array Datos del registro(NOMBRE,ID_USUARIO,EMAIL,EMAIL_CONTACTO,NOMBRE_CONTACTO,NUMERO_MOVIL)
     */

    public static function obtenerDatosUsuario($email)
    {

       $consulta= "SELECT NOMBRE,ID_USUARIO,EMAIL,EMAIL_CONTACTO,NOMBRE_CONTACTO,NUMERO_CONTACTO
       FROM USUARIO INNER JOIN USUARIO_CONTACTO ON USUARIO.ID_USUARIO=USUARIO_CONTACTO.USUARIO_ID_USUARIO WHERE EMAIL='$email'";
       
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();

            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;



        } catch (PDOException $e) {
            return false;
        }
    }



//------------------------------------------Altas e Insertar--------------------------------------------------------------

     /**
     * Insertar un nuevo usuario en el sistema.
     *
     * @param $email      email del usuario
     * @param $contrasena contraseña del usuario
     * @param $nombre     nombre del usuario     
     * @return PDOStatement
     */

    public static function insertarUsuario($email,$contrasena,$nombre)   

    {
        //Se encripta la contraseña.
        $encrypted_pass = password_hash($contrasena, PASSWORD_BCRYPT);

        $consulta = "INSERT INTO USUARIO (EMAIL,CONTRASENA,NOMBRE)VALUES('$email','$encrypted_pass','$nombre')";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($consulta);

        return $sentencia->execute(array($email,$encrypted_pass,$nombre));

    }


     /**
     * Insertar datos de contacto de un usuario.
     *
     * @param $idUsuario         identificador del usuario
     * @param $nombreContacto    nombre de contacto 
     * @param $emailContacto     email de contacto 
     * @param $numeroContacto    numero movil de contacto    
     * @return PDOStatement
     */


    public static function actualizarDatosContacto($idUsuario,$nombreContacto,$emailContacto,$numeroContacto)   

    {
  
        $consulta = "UPDATE USUARIO_CONTACTO SET NOMBRE_CONTACTO='$nombreContacto',EMAIL_CONTACTO='$emailContacto',NUMERO_CONTACTO='$numeroContacto' 
        WHERE USUARIO_ID_USUARIO=$idUsuario";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($consulta);

        return $sentencia->execute(array($idUsuario,$nombreContacto,$emailContacto,$numeroContacto));

    }

//------------------------------------------Modificar y Actualizar-------------------------------------------------------------------------------------


     /**
     * actualizar ubicacion de un usuario.
     *
     * @param $idUsuario       identificador del usuario
     * @param $latitud         coordenada latitud 
     * @param $longitud        coordenada longitud 
     * @param $direccion       direccion usuario   
     * @param $ciudad          ciudad usuario    
     * @return PDOStatement
     */

    public static function actualizarUbicacion($idUsuario,$latitud,$longitud,$direccion,$ciudad)    
    {

        $consulta = "UPDATE UBICACION SET LATITUD='$latitud',LONGITUD='$longitud',DIRECCION='$direccion',CIUDAD='$ciudad' 
        WHERE USUARIO_ID_USUARIO=$idUsuario";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($consulta);

        return $sentencia->execute(array($idUsuario,$latitud,$longitud,$direccion,$ciudad))
        ;

    }  


//------------------------------------------Funciones complementarias------------------------------------------------------------------------



}

?>