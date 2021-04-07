<?php
/******************************************************************************
VIZGARRA.LIVON.DANIEL

Aplicación No 6 (Carga aleatoria)
Definir un Array de 5 elementos enteros y asignar a cada uno de ellos un número (utilizar la
función rand). Mediante una estructura condicional, determinar si el promedio de los números
son mayores, menores o iguales que 6. Mostrar un mensaje por pantalla informando el
resultado.

*******************************************************************************/


$miArray = array(rand(0,10),rand(0,10),rand(0,10),rand(0,10),rand(0,10),rand(0,10));

unset(miArray[5]);

//$promedio = (miArray[1]+miArray[2]+miArray[3]+miArray[4]+miArray[5])/5;

$suma = array_sum($miArray);
echo "La suma de elementos es: ", $suma, "<br/>";
$conteo = count($miArray);
echo "La cantidada de elementos es: ", $conteo, "<br/>";
$promedio = $suma/$conteo;
echo "El promedio es: ", $promedio, "<br/>";

if($promedio > 6)
{
	echo "El promedio es mayor a 6";
}
elseif($promedio < 6)
{
	echo "El promedio es menor a 6";
}
else
{
	echo "El promedio es igual a 6";
}