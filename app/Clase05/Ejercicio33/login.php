<?php
/************************* 
VIZGARRA.DANIEL.SEBASTIAN

Aplicación Nº 29( Login con bd)
Archivo: Login.php
método:POST
Recibe los datos del usuario(clave,mail )por POST ,
crear un objeto y utilizar sus métodos para poder verificar si es un usuario registrado en la
base de datos,
Retorna un :
“Verificado” si el usuario existe y coincide la clave también.
“Error en los datos” si esta mal la clave.
“Usuario no registrado si no coincide el mail“
Hacer los métodos necesarios en la clase usuario.
**************************/
include "usuario.php";
   
    $l=array();


    $m = $_POST["mail"];
    $c = $_POST["clave"];
    echo "Mail: ".$m."\n"."Clave: ".$c."\n";

    $l = usuario::_SelectAll();            
    //usuario::_ImprimirLista($l);
    echo "Respuesta: ".usuario::_validarLogin($m, $c, $l);

?>