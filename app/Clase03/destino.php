<?php

    //echo "array get: ";
    //var_dump($_GET);// la super super
    //echo "<br/>array post: ";
    //var_dump($_POST);
	include "usuario.php";
   

    $nuevoUsuario = new usuario();    
    $nuevoUsuario->nombre = $_POST["usuario"];
    $nuevoUsuario->clave = $_POST["clave"];
    $nuevoUsuario->mail = $_POST["mail"];

    echo usuario::_validarUsuario($nuevoUsuario); 
    var_dump($nuevoUsuario);
?>

