<?php
/************************* 
VIZGARRA.DANIEL.SEBASTIAN

Aplicación No 27 (Registro BD)
Archivo: registro.php
método:POST
Recibe los datos del usuario( nombre,apellido, clave,mail,localidad )por POST ,
crear un objeto con la fecha de registro y utilizar sus métodos para poder hacer el alta,
guardando los datos la base de datos
retorna si se pudo agregar o no.
**************************/
include "usuario.php";
   
    $u = new usuario($_POST["nombre"], $_POST["apellido"], $_POST["clave"], $_POST["mail"],date("Y/m/d"), $_POST["localidad"]);
    //nombre apellido clave mail feReg localidad
    $u->_ToString();
    //var_dump($u);
    
    $resultado = $u->_InsertaUno();
    if($resultado>0)
    {
        echo "el id del usuario insertado es: ".$resultado;
    }
    else
    {
        echo"Error!!!!";
        var_dump($resultado);
    }    


?>