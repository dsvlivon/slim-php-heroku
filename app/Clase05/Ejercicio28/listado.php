<?php
    /********************************************************
    VIZGARRA.DANIEL.SEBASTIAN
    Aplicación Nº 28 ( Listado BD)
    Archivo: listado.php
    método:GET
    Recibe qué listado va a retornar(ej:usuarios,productos,ventas)
    cada objeto o clase tendrán los métodos para responder a la petición
    devolviendo un listado <ul> o tabla de html <table>
    *********************************************************/
	include "usuario.php";
    
    $archivo = $_GET["listado"];
    
    
    $l = array();
    $l = usuario::_CargaListaJson($archivo);
       
    echo usuario::_ImprimirLista($l);
    
    //var_dump($l);
    
?>

