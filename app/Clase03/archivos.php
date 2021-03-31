<?php

class archivos
{
    public $estado;
    public $p;

    static function _guardarCsv($msg)
    {
        $estado = null;
        //$cabecera = "NOMBRE".","."MAIL".","."ESTADO".","."FECHA"."<br/>";
       
        if($msg!=null)
	    {
            $p = fopen("usuarios.csv","a");//con "a" agrega datos y c "w" sobreescribe  
            fwrite($p, $cabecera);
            fwrite($p, $msg);
	        fclose($p);
            $estado = "archivo guardado!";
        }
        else
        {
            $estado =  "Error al escribir el archivo!";
        }
 	    return $estado;        

    }

}   


?>
