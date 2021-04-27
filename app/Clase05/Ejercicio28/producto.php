<?php
include "archivo.php";

class producto
{
    public $_id;
    public $_codigo;
    public $_nombre;
    public $_tipo;
    public $_stock;
    public $_precio;
    public $_fechaDeCreacion;
    public $_ultimaModificacion;
   
    public function __construct($i,$c,$n,$t,$s,$p,$f,$u)
    {
        $this->_id = $i;
        $this->_codigo = $c;  
        $this->_nombre = $n;
        $this->_tipo = $t;
        $this->_stock = $s;
        $this->_precio = $p;
        $this->_fechaDeCreacion = $f;
        $this->_ultimaModificacion = $u;
    }    
    #region DB
    public function _PersistirDB()
	{//codigo nombre tipo stock precio fechaDeCreacion  ultimaModificacion
        $objetoAccesoDato = archivo::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO productos 
        (codigo,nombre,tipo,stock,precio,fechaDeCreacion,ultimaModificacion)
        VALUES(:codigo,:nombre,:tipo,:stock,:precio,:fechaDeCreacion,:ultimaModificacion)");
        $consulta->bindValue(':codigo',$this->_codigo, PDO::PARAM_STR);
        $consulta->bindValue(':nombre',$this->_nombre, PDO::PARAM_STR);
        $consulta->bindValue(':tipo',$this->_tipo, PDO::PARAM_STR);
        $consulta->bindValue(':stock', $this->_stock, PDO::PARAM_INT);
        $consulta->bindValue(':precio', $this->_precio, PDO::PARAM_STR);//no estoy seguro de este?
        //StackOVerflow says: use PDO::PARAM_STR for all column types which are not of type int or Bool(osea q hay q reconvertirlo...)
        $consulta->bindValue(':fechaDeCreacion', $this->_localidad, PDO::PARAM_STR);
        $consulta->bindValue(':ultimaModificacion', $this->_localidad, PDO::PARAM_STR);
        $consulta->execute();		
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    public function _TraerTodos()
	{
        $objetoAccesoDato = archivo::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * from productos");
        $consulta->execute();			
        return $consulta->fetchAll(PDO::FETCH_CLASS, "producto");		
	}
    #endregion
    #region JSON
    static function _PersistirJSON($obj, $a)
    {
        if($obj->_codigo!= null && $obj->_id!=null)
        {    
            $msg = json_encode($obj);
            //echo $msg;
            archivo::_GuardarJSON($msg, $a);
        }
        else
        {
            echo "Faltan Datos";
        }
    }

    static function _CargaListaJSON($a)
    {
        $lista=array();
        if($a!=null)
        {
            $contenido = archivo::_CargarJSON($a);
            if($contenido!=null)
            {
                foreach ($contenido as $item) 
                {       
                    $n = $item->_nombre;
                    $c = $item->_codigo;
                    $t = $item->_tipo;
                    $s = $item->_stock;
                    $p = $item->_precio;
                    $i = $item->_id;
                    $obj = new  producto($c,$n,$t,$s,$p,$i);
                    //$prod = new producto($c,$n,$t,$s,$p,$i);
                    array_push($lista, $obj);
                }
            }
        }
        return $lista;
    }
    #endregion
    #region CSV
    static function _CargaListaCSV($a)
    {
        $lista=array();
        if($a!=null)
        {
            $lineas = archivo::_CargarCsv($a);
            if($lineas!=null)
            {
                for ($i=0; $i <count($lineas) ; $i++) 
                { 
                    $ats = explode(",",$lineas[$i]);
                    $c = $ats[0];
                    $n = $ats[1];
                    $t = $ats[2];
                    $s = $ats[3];
                    $p = $ats[4];
                    $i = $ats[5];
                    $obj = new  obj($c,$n,$t,$s,$p,$i);
                    array_push($lista, $obj);
                }
            }
        }
        return $lista;
    }   

    static function _PersistirCSV($obj, $a)
    {
        if($obj->_nombre!=null && $obj->_stock!=null && $obj->_id!=null)
        {
            $l = array();
            $l = usuario::_CargaLista($a);
            foreach ($l as $item) 
            {
                if($item->_codigo != $obj->_codigo && $item->_id != $obj->_id)
                {
                    $msg = "\n".$obj->_codigo.",".$obj->_nombre.",".$obj->_tipo.",".$obj->_stock.",".$obj->_precio.",".$obj->_id.";";
                    archivo::_GuardarCsv($msg, $a);
                }    
            }            
        }
        else
        {
            echo "Faltan Datos";
        }
    }
    #endregion
    #region Propias
    static function _validarProducto($obj, $a)
    {
        if($obj->_codigo!=null && $obj->_id!=null)
        {
            $l = array();
            $l = producto::_CargaListaJson($a);
            //var_dump($l);
            if(producto::_BuscarPorCodigo($obj, $l)==false)
            {
                array_push($l, $obj);
                producto::_PersistirJSON($obj, $a);
                echo "\nIngresado";
                return $l;
            }
            else{
                foreach ($l as $item) 
                {
                    if($item->_codigo == $obj->_codigo)
                    {
                       $item->_stock += $obj->_stock;
                    }
                }
                //producto::_ImprimirLista($l);
                archivo::_GuardarArray($l, $a);
                echo "\nActualizado";
            }
            // echo "lista salida:\n";
            // producto::_ImprimirLista($l);
        }
        else{
            echo "\nNo se pudo hacer";
        }
    }

    public function _ToString()
    {
        $mensaje =  "Nombre: ".$this->_nombre."<br/>".
                    "Mail: ".$this->_codigo."<br/>".
                    "Stock: ".$this->_stock."<br/>".
                    "Precio: ".$this->_precio."<br/>".
                    "ID: ".$this->_id."<br/>".
                    "<br/>";     
        echo "DATOS DEL USUARIO: <br/>".$mensaje;
    }

    static function _ImprimirLista($l)
    {
        if(is_array($l))
        {          
            foreach ($l as  $item) 
            {
                echo $item->_ToString();
                ////////////////////////////////////// "lo normal"
                // echo "<ul>"."<br/>";
                // echo "<li>".$item->_nombre."</li>";
                // echo "<li>".$item->_mail."</li>";
                // echo "<li>".$item->_clave."</li>";
                // echo "</ul>";
                ////////////////////////////////////// "formato csv"
                // $path = "Usuarios/Fotos/".$item->_nombre.".png";
                // echo "<ul>"."<br/>";
                // echo "<li>".$item->_nombre."/".$item->_mail."/".$item->_fecha."/".$item->_id."/"."<img src=\"$path\">"."</li>";
                // echo "</ul>";
            }
        }
        else
        {
            echo "Error en la lista";
        }
    }

    static function _BuscarPorCodigo($obj, $l)
    {
        foreach ($l as $item) 
        {      
            if($item->_codigo == $obj->_codigo)
            {
                return true;
            }            
        }      
        return false;
    }

    #endregion
}
?>
