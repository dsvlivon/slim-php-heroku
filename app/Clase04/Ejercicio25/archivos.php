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
   
    static function _CargarCsv($archivo)
    {
        $vec = array();       
        
        if($archivo!=null)
        {
            if(file_exists($archivo))
            {
                $p = fopen($archivo, "r");
                while(!feof($p))
                {
                    $linea = fgets($p);
                    //$vec = fgetcsv($p,200,",","\n");
                    array_push($vec, $linea);      
                    fclose($p);
                }
                return $vec;
            }
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

    static function _GuardarArray($l,$archivo)
    {      
        if($l!=null)
        {
            $pudo = 0;    
            $file = fopen($archivo, "w");
            $pudo = fwrite($file, json_encode($l));
            fclose($file);    
            return $pudo;        //GRACIAS JOSIAS XQ NO M SALIA
        }          
        else
        {
            echo "Error al guardar Datos!";
            return false;
        }            
        //     $p = fopen($archivo, "w");
        //     fwrite($p,"[");            
        //     for($i=0; $i < count($l)-1; $i++)
        //     {
        //         $msg = json_encode($l[$i]);
        //         if($i<count($l)-1){
        //             fwrite($p, $msg.",");
        //         }
        //         else{
        //             fwrite($p, $msg);
        //         }
    }

    static function _CargarJSON($archivo)
    {
        $vec = array();    
        if($archivo!=null)
        {
            if(file_exists($archivo))
            {
                $p = fopen($archivo, "r");
                $contenido = fread($p, filesize($archivo));
                $vec = json_decode($contenido);
                fclose($p);
                return $vec;
            }
        }
        else
        {
            echo "Error al cargar Archivo!";
        }
    }
}   

?>
