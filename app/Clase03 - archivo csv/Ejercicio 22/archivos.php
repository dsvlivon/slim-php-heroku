<?php

class archivos
{
    public $p;

    static function _GuardarCsv($m)
    {              
        if($m!=null)
        {
            $p = fopen("usuarios.csv","a");//con "a" agrega datos y c "w" sobreescribe  
            fwrite($p, $m);
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
}   

?>
