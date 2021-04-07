<?php
/******************************************************************************
VIZGARRA.LIVON.DANIEL

Aplicación No 7 (Mostrar impares)
Generar una aplicación que permita cargar los primeros 10 números impares en un Array.
Luego imprimir (utilizando la estructura for) cada uno en una línea distinta (recordar que el
salto de línea en HTML es la etiqueta <br/>). Repetir la impresión de los números utilizando
las estructuras while y foreach.

*******************************************************************************/


$miArray = array();
$flag = 0;

for($i=0;$i<19;$i++)
{
	if($flag==0)
	{
    		$miArray[0] = 1;
    		$flag = 1;
	}
	else 
	{
    		$miArray[$i] = $i+2;
	}
	
}	

for($j=0;$j<10;$j++)
{
	echo $miArray[$j], "<br/>";
}

$k =0;
while($k<10)
{
	echo $miArray[$j], "<br/>";
	$k++;
}	

foreach($miArray as $valor)
{
	echo $valor, "<br/>";
}
