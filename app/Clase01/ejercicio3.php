<?php
/*
Aplicación No 3 (Obtener el valor del medio)
Dadas tres variables numéricas de tipo entero $a, $b y $c realizar una aplicación que muestre
el contenido de aquella variable que contenga el valor que se encuentre en el medio de las tres
variables. De no existir dicho valor, mostrar un mensaje que indique lo sucedido.
Ejemplo 1: $a = 6; $b = 9; $c = 8; => se muestra 8.
Ejemplo 2: $a = 5; $b = 1; $c = 5; => se muestra un mensaje “No hay valor del medio”
Ej 3: 1   5   3     el 3 es del medio
Ej 3: 3  5   1     el 3 es del medio
 
 VIZGARRA.LIVON.DANIEL
 */
$a = 6; 
$b = 9; 
$c = 8;

// $a = 5; 
// $b = 1; 
// $c = 5;

// $a = 1; 
// $b = 5; 
// $c = 3;

// $a = 5; 
// $b = 3; 
// $c = 1

if($b>$a && $b<$c || $b<$a && $b>$c)
{
	echo $b;
}
elseif ($a>$c && $a<$b || $a<$c && $a>$b) 
{
	echo $a;
} 
elseif ($c>$a && $c<$b || $c<$a && $c>$b) 
{
	echo $c;
}
else {
		echo "No hay valor del medio";
}

?>