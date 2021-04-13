<?php

class archivos
{
    public $p;

    static function _GuardarCsv($m, $archivo)
    {              
        if($m!=null)
        {
            if (file_exists($archivo)) 
            {
                $msg = "\n".$m;                
            }
            else
            {
                $msg = $m;
            }
            $p = fopen($archivo,"a");//con "a" agrega datos y c "w" sobreescribe  
            fwrite($p, $msg);
	        fclose($p);
            echo "Datos Guardados!";
                    
            return true;        
        }
        else
        {
            echo "Error al guardar Datos!";
            return false;
        }
    }
   
    static function _CargarCsv($file)
    {
        $p = fopen($file, "r");
        $vec = array();       
        
        if($p!=null)
        {
            while(!feof($p))
            {
                $linea = fgets($p);
                //$vec = fgetcsv($p,200,",","\n");
                array_push($vec, $linea);      
            }
            fclose($p);
            return $vec;
        }
        else
        {
            echo "Error al cargar Archivo!";
        }
    }

    static function _GuardarJSON($m, $archivo)
    {              
        if($m!=null)
        {
            if (!file_exists($archivo))
            {
                $p = fopen($archivo, "w");
                fwrite($p, "[".$m."]");
            }
            else{
                $p = fopen($archivo, "c");
                fseek($p, filesize($archivo)-1);
                fwrite($p, ",".$m."]");
            }
            //[{"_nombre":"fede","_clave":"1234","_mail":"fede@utn","_fecha":"2021\/04\/12","_id":1857},
            //{"_nombre":"daniel","_clave":"1234","_mail":"daniel@utn","_fecha":"2021\/04\/12","_id":8078}]   
            fclose($p);              
            echo "Datos Guardados!";
            return true;     
        }
        else
        {
            echo "Error al guardar Datos!";
            return false;
        }
    }
}   

?>
