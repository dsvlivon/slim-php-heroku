<?php
/********************************************************
VIZGARRA.DANIEL.SEBASTIAN

Aplicación Nº 30 ( AltaProducto BD)
Archivo: altaProducto.php
método:POST
Recibe los datos del producto(código de barra (6 sifras ),nombre ,tipo, stock, precio )
por POST, carga la fecha de creación y crear un objeto ,se debe utilizar sus métodos para 
poder verificar si es un producto existente, si ya existe el producto se le suma el 
stock , de lo contrario se agrega . Retorna un :
“Ingresado” si es un producto nuevo
“Actualizado” si ya existía y se actualiza el stock.
“no se pudo hacer“si no se pudo hacer
Hacer los métodos necesarios en la clase
*********************************************************/
include "producto.php";
//include "usuario.php";

$l = array();

$c = $_POST["codigo"];
$n = $_POST["nombre"];
$t = $_POST["tipo"];
$s = $_POST["stock"];
$p = $_POST["precio"];


$prod = new producto();
$prod->_setProducto($c,$n,$t,$s,$p);

$l = producto::_SelectAll();            
//producto::_ImprimirLista($l);  
producto::_validarProducto($prod, $l);

?>