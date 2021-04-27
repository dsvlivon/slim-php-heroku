<?php
/************************* 
VIZGARRA.DANIEL.SEBASTIAN

Aplicación Nº 33 ( ModificacionProducto BD)
Archivo: modificacionproducto.php
método:POST
Recibe los datos del producto(código de barra (6 sifras ),nombre ,tipo, stock, precio )por POST,
crear un objeto y utilizar sus métodos para poder verificar si es un producto existente,
si ya existe el producto el stock se sobrescribe y se cambian todos los datos excepto:
el código de barras .
Retorna un :
“Actualizado” si ya existía y se actualiza
“no se pudo hacer“si no se pudo hacer
Hacer los métodos necesarios en la clase
**************************/
include "producto.php";
   
    $l=array();
    
    $obj = new producto();
    $respuesta = $obj->_cambioDeClave($_POST["codigo"], 
                                    $_POST["nombre"], 
                                    $_POST["tipo"], 
                                    $_POST["precio"],
                                    $_POST["stock"]);
    if($respuesta)
    {
        echo "si se pudo";
    }
    else
    {
        echo "no se pudo";
    }

?>