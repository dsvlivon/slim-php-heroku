<?php
/***********************************
VIZGARRA.LIVON.DANIEL
Aplicación No 14 (Par e impar)
Crear una función llamada esPar que reciba un valor entero como parámetro y devuelva TRUE
si este número es par ó FALSE si es impar.
Reutilizando el código anterior, crear la función esImpar.
***********************************/


$numero = rand(0,100);

if(esPar($numero))
{
    echo "el $numero es par";
}
else
{
    echo "el $numero NO es par";
}

function esPar($valor)
{
    if ($valor%2==0)
    {
        return true;
    }
    else
    {
        return false;
    }    
}

?>