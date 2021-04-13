<?php
    /********************************************************
    Aplicación Nº 23 (Registro JSON)
    Archivo: registro.php
    método:POST
    Recibe los datos del usuario(nombre, clave,mail )por POST ,
    crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000).
    crear un dato con la fecha de registro , toma todos los datos y utilizar sus métodos para
    poder hacer el alta,
    guardando los datos en usuarios.json y subir la imagen al servidor en la carpeta
    Usuario/Fotos/.
    retorna si se pudo agregar o no.
    Cada usuario se agrega en un renglón diferente al anterior.
    Hacer los métodos necesarios en la clase usuario.
    *********************************************************/
	include "usuario.php";
   
    // echo "hola mundo";  
    // $l = array();
    // $l = usuario::_CargaLista("usuarios.csv");

    $n = $_POST["nombre"];
    $c = $_POST["clave"];
    $m = $_POST["mail"];
    $d = date("Y/m/d");    
    $i = rand(0,10000);

    //var_dump($_FILES);
    //echo $path;
    
    $u = new usuario($n, $c, $m, $d, $i);
    usuario::_PersistirJSON($u,"usuarios.json");
    
    $pic = $_FILES["foto"];
    $path = $pic["tmp_name"];
    $newPath = "Usuarios/Fotos/".$u->_nombre.".png";
    move_uploaded_file($path,$newPath);
    echo "<img src=\"$newPath\">";
?>

