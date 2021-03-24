<?php
/******************************************************************************
VIZGARRA.LIVON.DANIEL
Aplicación No 12 (Invertir palabra)
Realizar el desarrollo de una función que reciba un Array de caracteres y que invierta el orden
de las letras del Array.
Ejemplo: Se recibe la palabra “HOLA” y luego queda “ALOH”.

*******************************************************************************/

$v = "holax";

/*
function NombreFuncion($par_1, $par_2,..., $par_n)
{
    //código
}
*/
function InvertirPalabra($array)
{
    echo "Palabra original: ", $string. "<br/>";
    echo "Palabra invertida: ";
    for($i=strlen($string)-1;$i>=0;$i--)
    {
        echo($string[$i]);
    }
}

InvertirPalabra($v);