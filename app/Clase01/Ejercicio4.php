<?php
/************************************************************
DANIEL.VIZGARRA.LIVON

Aplicación Nº 4 (Calculadora)
Escribir un programa que use la variable $ operador que pueda almacenar los símbolos
matemáticos: ‘ + ’, ‘ - ’, ‘ / ’ y ‘ * ’; y definir dos variables enteras $ op1 y $ op2 . De acuerdo al
símbolo que tenga la variable $operador, deberá realizarse la operación indicada y mostrarse el
resultado por pantalla.
************************************************************/
echo "CALCULADORA<br />";

$op1 = rand();
$op2 = rand();
$operador = rand(0,3);
$result;
echo $op1,"<br />";
echo $op2, "<br />";

switch ($operador) 
{
	case 0://suma
		$result = $op1+$op2;
	case 1://resta
		$result = $op1-$op2;
		break;	
	case 2://multi
		$result = $op1*$op2;
	case 3://diviison
		if($op2==0)
		{
			$result = 0;
		}
		else
		{
			$result = $op1/$op2;	
		}
		
	default:
		# code...
		break;
}
echo "resultado: ", $result;

?>