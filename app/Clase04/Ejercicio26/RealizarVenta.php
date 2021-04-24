<?php
/********************************************************
VIZGARRA.DANIEL.SEBASTIAN

Aplicación Nº 26 (RealizarVenta)
Archivo: RealizarVenta.php
método:POST
1-Recibe los datos del producto(código de barra), del usuario (el id )y la cantidad de ítems ,por
POST .
2-Verificar que el usuario y el producto exista y tenga stock.
3-crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000).
4-carga los datos necesarios para guardar la venta en un nuevo renglón.
Retorna un :
“venta realizada”Se hizo una venta
“no se pudo hacer“si no se pudo hacer
Hacer los métodos necesarios en las clases
*********************************************************/
include "venta.php";



$codigoProducto = $_POST["codigo"];
$cantidad = $_POST["cantidad"];
$idUsuario = $_POST["id"];
$idVenta = rand(0,10000);


$v1 = new ventas($codigoProducto,$cantidad,$idUsuario,$idVenta);
//$v2 = new ventas($_POST["codigo"],$_POST["cantidad"],$_POST["id"],rand(0,10000));
$v1->_Vender("usuarios.json", "productos.json");


?>