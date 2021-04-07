<?php
    /********************************************************
    Aplicación No 20 (Registro CSV)
    *********************************************************/
	include "usuario.php";
   
    $estado=null;

    $n = $_POST["nombre"];
    $c = $_POST["clave"];
    $m = $_POST["mail"];

    $nuevoUsuario = new usuario($n, $c, $m);

    $estado = usuario::_validarUsuario($nuevoUsuario);
    //var_dump($estado);
    switch ($estado) 
    {
        case 0:
            echo "DATOS INCOMPLETOS<br/>";           
            break;
        case 1:
            echo "Bienvenido ADMIN:<br/>";
            echo $nuevoUsuario->_ToString();//metodo de instancia
            break;
        case 2:
            echo "Bienvenido USUARIO:<br/>";
            echo $nuevoUsuario->_ToString();//metodo de instancia
            usuario::_Persistir($nuevoUsuario);//metodo estatico           
            break;    
        default:
            echo "ANDA A LA CANCHA BOBO...<br/>";
            break;
    }
    
?>

