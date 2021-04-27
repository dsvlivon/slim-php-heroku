<?php
/************************* 
VIZGARRA.DANIEL.SEBASTIAN

Aplicación Nº 32(Modificacion BD)
Archivo: ModificacionUsuario.php
método:POST
Recibe los datos del usuario(nombre, clavenueva, clavevieja,mail )por POST ,
crear un objeto y utilizar sus métodos para poder hacer la modificación,
guardando los datos la base de datos
retorna si se pudo agregar o no.
Solo pueden cambiar la clave
**************************/
include "usuario.php";
   
    $l=array();
    
    $u = new usuario();
    $respuesta = $u->_cambioDeClave($_POST["nombre"], 
                       $_POST["mail"], 
                       $_POST["claveNueva"], 
                       $_POST["claveVieja"]);
    if($respuesta)
    {
        echo "si se pudo";
    }
    else
    {
        echo "no se pudo";
    }

?>