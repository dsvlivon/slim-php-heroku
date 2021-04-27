<?php
    /********************************************************
    Aplicación Nº 28 ( Listado BD)
    Archivo: listado.php
    método:GET
    Recibe qué listado va a retornar(ej:usuarios,productos,ventas)
    cada objeto o clase tendrán los métodos para responder a la petición
    devolviendo un listado <ul> o tabla de html <table>
    *********************************************************/
	include_once "usuario.php";
    include_once "producto.php";
    

    $a = $_GET["listado"];
    $l = array();
    
    switch($a)
    {
        case "usuarios.json":
            $l = usuario::_SelectAll();            
            usuario::_ImprimirLista($l);            
        break;
        case "productos.json":
            //echo "prod";
            $l = producto::_SelectAll();            
            producto::_ImprimirLista($l);        
        break; 
        default:
        echo "ups...";
        break;
    }
   
?>

