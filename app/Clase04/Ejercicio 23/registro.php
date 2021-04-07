<?php
    /********************************************************
    Aplicación Nº 23 (Registro JSON)
    Archivo: registro.php
    método:POST
    Recibe los datos del usuario(nombre, clave,mail )por POST ,[OK]
    crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000).[OK]
    crear un dato con la fecha de registro , toma todos los datos y utilizar sus métodos para
    poder hacer el alta,
    guardando los datos en usuarios.json y subir la imagen al servidor en la carpeta
    Usuario/Fotos/.
    retorna si se pudo agregar o no.
    Cada usuario se agrega en un renglón diferente al anterior.
    Hacer los métodos necesarios en la clase usuario.
    *********************************************************/
	include "usuario.php";
   
    $lista = array();
    $lista = usuario::_CargaLista("usuarios.csv");

    $nombre = $_POST["nombre"];
    $clave = $_POST["clave"];
    $mail = $_POST["mail"];

    
    
    $nuevo = new usuario($nombre, $clave, $mail);
    $nuevo->_fecha = $date("Y/m/d");
    $$nuevo->_id = rand(0,10000);

    usuario::_PersistirCsv($nuevo);
    //echo usuario::_validarUsuario($nuevo);
    
?>

