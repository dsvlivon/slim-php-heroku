<?php

	include "usuario.php";
   
    //ESTA ES LA FORMA DIRECTA SIN CONSTRUCTOR
    /*$nuevoUsuario = new usuario();
    $nuevoUsuario->_nombre = $_POST["nombre"];
    $nuevoUsuario->_clave = $_POST["clave"];
    $nuevoUsuario->_mail = $_POST["mail"];*/
 
    //ASI SERIA C EL CONSTRUCTOR
    $n = $_POST["nombre"];
    $c = $_POST["clave"];
    $m = $_POST["mail"];
    $nuevoUsuario = new usuario($n, $c, $m);
    echo $nuevoUsuario->_ToString();//ASI SE LLAMA A UNA FUNC D INSTANCIA

    echo usuario::_validarUsuario($nuevoUsuario);//ASI LLAMA UNA FUNC ESTATICA D LA CLASE USUARIO
   
?>

