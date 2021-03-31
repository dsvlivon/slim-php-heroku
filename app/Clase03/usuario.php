<?php
include "archivos.php";

class usuario
{
    public $nombre;
    public $clave;
    public $mail;

    static function _validarUsuario($usuario)
    {
        $estado=null;

        /*if(isset($usuario->nombre) && isset($usuario->clave) && isset($usuario->mail))
	    {
            if($usuario->nombre == "admin" && $usuario->clave == "1234")
            {
                $estado = "OK";               
            }
            else
            {
                $estado =  "USUARIO NO REGISTRADO";
            }
        }
        else
        {
            $estado =  "faltan datos";
        }*/
//        $mensaje = "Usuario: ". $usuario->nombre."\n"."Mail: ". $usuario->mail."\n". "Estado: ". $estado. "\n"."Fecha: ". date("Ymd");
        $mensaje = $usuario->nombre.",".$usuario->mail.",".$estado.",".date("Ymd");

        archivos::_guardarCsv($mensaje); 
    }

}   


?>
