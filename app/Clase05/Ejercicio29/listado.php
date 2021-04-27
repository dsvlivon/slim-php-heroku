<?php
    /********************************************************
    Aplicación Nº 28 ( Listado BD)
    Archivo: listado.php
    método:GET
    Recibe qué listado va a retornar(ej:usuarios,productos,ventas)
    cada objeto o clase tendrán los métodos para responder a la petición
    devolviendo un listado <ul> o tabla de html <table>
    *********************************************************/
	include "usuario.php";
   
    $a = $_GET["listado"];
    $l = array();
    
    switch($a)
    {
        case "usuarios.json":
            $l = usuario::_SelectAll();            
            usuario::_ImprimirLista($l);            
        break;
        case "productos.json":
        break;
        case "ventas.json":
        break;
        default:
        break;
    }
    $l = array();
    $l = usuario::_CargaListaJson("usuarios.json");
       
    echo usuario::_ImprimirLista($l);
    
   
    
?>

