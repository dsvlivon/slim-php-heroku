<?php
/************************* 
VIZGARRA.DANIEL.SEBASTIAN

Aplicación Nº 22 ( Login)
Archivo: Login.php
método:POST
Recibe los datos del usuario(clave,mail )por POST ,
crear un objeto y utilizar sus métodos para poder verificar si es un usuario registrado,
Retorna un :
“Verificado” si el usuario existe y coincide la clave también.
“Error en los datos” si esta mal la clave.
“Usuario no registrado si no coincide el mail“
Hacer los métodos necesarios en la clase usuario
**************************/
include "usuario.php";
   
    $l=array();


    $m = $_POST["mail"];
    $c = $_POST["clave"];

    $l = usuario::_SelectAll();
    echo usuario::_validarLogin($m, $c, $l);


?>