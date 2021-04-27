<?php
/************************* 
VIZGARRA.DANIEL.SEBASTIAN

Aplicación No 27 (Registro BD)
Archivo: registro.php
método:POST
Recibe los datos del usuario( nombre,apellido, clave,mail,localidad )por POST ,
crear un objeto con la fecha de registro y utilizar sus métodos para poder hacer el alta,
guardando los datos la base de datos
retorna si se pudo agregar o no.
**************************/
include "usuario.php";
   

    $n = $_POST["nombre"]; 
    $a = $_POST["apellido"]; 
    $c = $_POST["clave"];
    $m = $_POST["mail"];
    $d = date("Y/m/d"); 
    $l = $_POST["localidad"];

    //si el usuario ya existe, dame el id
    //si el usuario no existe, encontrar un id disponible y retornar
    $obj = new usuario();//
    $obj->_dummy($n,$a,$c,$m,$d,$l);
    //$u = new usuario($_POST["nombre"], $_POST["apellido"], $_POST["clave"], $_POST["mail"],date("Y/m/d"), $_POST["localidad"]);
    $resultado = $obj->_PersistirDB();
    if($resultado>0)
    {
        echo "el id del usuario insertado es: ".$resultado;
    }
    else
    {
        echo"Error!!!!";
        var_dump($resultado);
    }    


?>