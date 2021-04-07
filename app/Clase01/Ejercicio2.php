<?php
/******************************************************************************
VIZGARRA.LIVON.DANIEL

Aplicación Nº 2 (Mostrar fecha y estación)
Obtenga la fecha actual del servidor (función date ) y luego imprímala dentro de la página con
distintos formatos (seleccione los formatos que más le guste). Además indicar que estación del
año es. Utilizar una estructura selectiva múltiple.*******************************************************************************/

// Imprime algo como: Monday 8th of August 2005 03:12:46 PM
//echo date('l F Y');
$value = date('d m Y');
//echo "fecha actual: \n", $value;
echo "fecha actual: ",$value, "<br  />";

//echo substr('abcdef', 1, 3);  // bcd
$auxvalue = substr($value, 3,2);
echo "auxvalue: ", $auxvalue, "<br />";

switch ($auxvalue) {
    case '01':
        echo "Mes: Enero";
        break;
    case '02':
    echo "Mes: Febrero";
        break;
    case '03':
    echo "Mes: Marzo";
        break;
    case '04':
    echo "Mes: Abril";
        break;
    case '05':
    echo "Mes: Mayo";
        break;
    case '06':
    echo "Mes: Junio";
        break;
    case '07':
    echo "Mes: Juli";
        break;
    case '08':
    echo "Mes: agosto";
        break;
    case '09':
    echo "Mes: septiember";
    break;
    case '10':
    echo "Mes: Octubre en telefe";
    break;
    case '11':
    echo "Mes: septiember";
    break;
    case '12':
    echo "Mes: Diciembre";
    break;
    default:
                break;
}


/*
// Imprime algo como: 2000-07-01T00:00:00+00:00
echo date(DATE_ATOM, mktime(0, 0, 0,8, 1, 2000));
*/
?>