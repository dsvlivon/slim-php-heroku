<?php
/********************************************************
VIZGARRA.DANIEL.SEBASTIAN

Aplicación Nº 31 (RealizarVenta BD )
Archivo: RealizarVenta.php
método:POST
Recibe los datos del producto(código de barra), del usuario (el id )y la cantidad de ítems ,por
POST .
Verificar que el usuario y el producto exista y tenga stock.
Retorna un :
“venta realizada”Se hizo una venta
“no se pudo hacer“si no se pudo hacer
Hacer los métodos necesarios en las clases
*********************************************************/
include "venta.php";


$idProducto = $_POST["idProducto"];
$cantidad = $_POST["cantidad"];
$idUsuario = $_POST["idUsuario"];



$v1 = new venta();
$v1->_setVenta($idProducto, $cantidad, $idUsuario);

//$v2 = new ventas($_POST["codigo"],$_POST["cantidad"],$_POST["id"],rand(0,10000));
$v1->_VenderDB();

?>