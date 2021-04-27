<?php

class archivo
{
    public $p;

    #region DB
    private static $ObjetoAccesoDatos;
    private $objetoPDO;
 
    private function __construct()
    {
        try {//ACA SIEMPRE ES IMPORTANTE EDITAR EL NOMBRE DE LA DB (no confundir c nombre de tabla)!!
            $this->objetoPDO = new PDO('mysql:host=localhost;dbname=utn;charset=utf8', 'root', '', array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            $this->objetoPDO->exec("SET CHARACTER SET utf8");
            } 
        catch (PDOException $e) { 
            print "Error!: " . $e->getMessage(); 
            die();
        }
    }
 
    public function RetornarConsulta($sql)
    { 
        return $this->objetoPDO->prepare($sql); 
    }
     public function RetornarUltimoIdInsertado()
    { 
        return $this->objetoPDO->lastInsertId(); 
    }
 
    public static function dameUnObjetoAcceso()
    { 
        if (!isset(self::$ObjetoAccesoDatos)) {          
            self::$ObjetoAccesoDatos = new archivo(); 
        } 
        return self::$ObjetoAccesoDatos;        
    } 
     
    public function __clone()
    {// Evita que el objeto se pueda clonar 
        trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR); 
    }  
    #endregion
    #region JSON
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
            return $pudo;//GRACIAS JOSIAS XQ NO M SALIA
        }           
        else
        {
            echo "Error al guardar Datos!";
            return false;
        }      
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
    #endregion
    #region CSV
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
    #endregion
    #region XML
    //...
    #endregion
    #region TXT
    //...
    #endregion
}   

?>
