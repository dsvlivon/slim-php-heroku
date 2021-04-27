<?php
include_once "archivo.php";

class producto
{
    public $id;
    public $codigo;
    public $nombre;
    public $tipo;
    public $stock;
    public $precio;
    public $fechaDeCreacion;
    public $ultimaModificacion;
    //id,codigo,nombre,tipo,stock,precio,fechaDeCreacion,ultimamodificacion
    public function __construct(){}
     
    #region Propias
    public function _setProducto($c,$n,$t,$s,$p)
    {
        ///$this->_id = $i;
        $this->codigo = $c;  
        $this->nombre = $n;
        $this->tipo = $t;
        $this->stock = $s;
        $this->precio = $p;
        //$this->fechaDeCreacion = $f;
        //$this->ultimaModificacion = $u;
    } 

    static  function _SetCodigo($c)
    {
        if(strlen($c)==6)
        {
            return $c;
        } 
        return false;
    }

    static function _VerificarExistencia($id, $cantidad, $lista)
    {
        foreach ($lista as $item) 
        {
            if($item->id == $id && $item->stock >=$cantidad)
            {
                return true;
            }
        }
        return false;
    }

    static function _validarProducto($obj, $l)
    {
        if($obj != null && $l != null)
        {
            $item = producto::_BuscarPorCodigo($obj,$l); 
            if($item == FALSE)
            {
                $obj->fechaDeCreacion = date("Y/m/d");
                $obj->ultimaModificacion = date("Y/m/d");
                echo "INGRESADO: ".$obj->_ToString();
                //echo "\nIngresado"."\nId nro.: ".$obj->_Insert();
            }
            else
            {//Recibe los datos del producto(código de barra (6 sifras ),nombre ,tipo, stock, precio )
                $item->nombre = $obj->nombre;
                $item->tipo = $obj->tipo;
                $item->precio = $obj->precio;
                $item->ultimaModificacion = date("Y/m/d");
                $item->stock += $obj->stock;                    
                echo "ACTUALIZADO!!!"."\n".($item->_Update())->_ToString();
            }
        }
        else
        {
            echo "\nNo se pudo hacer";
        }
    }

    static function _validarProducto2($obj, $a)
    {
        if($obj->codigo!=null && $obj->id!=null)
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
                    if($item->codigo == $obj->codigo)
                    {
                       $item->stock += $obj->stock;
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
    {//id,codigo,nombre,tipo,stock,precio,fechaDeCreacion,ultimamodificacion
        $mensaje =  "ID.: ".$this->id."<br/>".
                    "Codigo: ".$this->codigo."<br/>".
                    "Nombre: ".$this->nombre."<br/>".
                    "Tipo: ".$this->tipo."<br/>".
                    "Stock: ".$this->stock."<br/>".
                    "Precio: ".$this->precio."<br/>".
                    "Fecha de Creacion: ".$this->fechaDeCreacion."<br/>".
                    "Ultima modificacion: ".$this->ultimaModificacion."<br/>".
                    "<br/>";     
        echo "DATOS DEL PRODUCTO: <br/>".$mensaje;
    }

    static function _ImprimirLista($l)
    {
        if(is_array($l))
        {          
            foreach ($l as  $item) 
            {//codigo nombre tipo stock precio fechaDeCreacion  ultimaModificacion
                //echo $item->_ToString();
                ////////////////////////////////////// "lo normal"
                echo "<ul>"."<br/>";
                echo "<li>".$item->codigo."</li>";
                echo "<li>".$item->nombre."</li>";
                echo "<li>".$item->stock."</li>";
                echo "<li>".$item->precio."</li>";
                echo "<li>".$item->fechaDeCreacion."</li>";
                echo "<li>".$item->ultimaModificacion."</li>";
                echo "</ul>";
                //////////////////////////////////// "formato csv"
                // $path = "Usuarios/Fotos/".$item->nombre.".png";
                // echo "<ul>"."<br/>";
                // echo "<li>".$item->nombre."/".$item->mail."/".$item->fecha."/".$item->id."/"."<img src=\"$path\">"."</li>";
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
            if($item->codigo == $obj->codigo)
            {
                return $item;
            }            
        }      
        return false;
    }

    #endregion
    #region DB
    public function _Insert()
	{//codigo nombre tipo stock precio fechaDeCreacion  ultimaModificacion
        $objetoAccesoDato = archivo::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO productos 
        (codigo,nombre,tipo,stock,precio,fechaDeCreacion,ultimaModificacion)
        VALUES(:codigo,:nombre,:tipo,:stock,:precio,:fechaDeCreacion,:ultimaModificacion)");
        $consulta->bindValue(':codigo',$this->codigo, PDO::PARAM_STR);
        $consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':tipo',$this->tipo, PDO::PARAM_STR);
        $consulta->bindValue(':stock', $this->stock, PDO::PARAM_INT);
        $consulta->bindValue(':precio', $this->precio, PDO::PARAM_STR);//no estoy seguro de este?
        //StackOVerflow says: use PDO::PARAM_STR for all column types which are not of type int or Bool(osea q hay q reconvertirlo...)
        $consulta->bindValue(':fechaDeCreacion', $this->fechaDeCreacion, PDO::PARAM_STR);
        $consulta->bindValue(':ultimaModificacion', $this->ultimaModificacion, PDO::PARAM_STR);
        $consulta->execute();		
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    public function _Delete()
    {
        $objetoAccesoDato = archivo::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("DELETE FROM productos 				
        WHERE id=:id");	
        $consulta->bindValue(':id',$this->id, PDO::PARAM_INT);		
        $consulta->execute();
        return $consulta->rowCount();
    }

    public function _Update()
    {//codigo nombre tipo stock precio fechaDeCreacion  ultimaModificacion
        $objetoAccesoDato = archivo::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE productos 
        SET codigo=:codigo, nombre=:nombre, tipo=:tipo, stock=:stock, precio=:precio, ultimaModificacion=:ultimaModificacion
        WHERE id=:id");
        $consulta->bindValue(':id',$this->id, PDO::PARAM_INT);
        $consulta->bindValue(':codigo',$this->codigo, PDO::PARAM_INT);
        $consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
        $consulta->bindValue(':stock', $this->stock, PDO::PARAM_STR);
        $consulta->bindValue(':precio', $this->precio, PDO::PARAM_STR);//NO ES UN FLOAT!!
        //no le pasaria la fecha d creacion... PONELE!
        $consulta->bindValue(':ultimaModificacion', $this->ultimaModificacion);
        $consulta->execute();
        return $this;
    }

    static function _SelectAll()
    {//id codigo nombre tipo stock precio fechaDeCreacion  ultimaModificacion
        $l = array();
        $objetoAccesoDato = archivo::dameUnObjetoAcceso(); 
        /*$consulta =$objetoAccesoDato->RetornarConsulta("SELECT 
        codigo AS codigo, nombre AS nombre, tipo AS tipo, stock AS stock, precio AS precio, fechaDeCreacion AS fechaDeCreacion, ultimaModificacion AS ultimaModificacion
        FROM productos");/*/
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM productos");
        $consulta->execute();			
        $l = $consulta->fetchAll(PDO::FETCH_CLASS, "producto");
        return $l;
	}

    #endregion
    #region JSON
    static function _PersistirJSON($obj, $a)
    {
        if($obj->codigo!= null && $obj->id!=null)
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
                {//id,codigo,nombre,tipo,stock,precio,fechaDeCreacion,ultimamodificacion       
                    $n = $item->nombre;
                    $c = $item->codigo;
                    $t = $item->tipo;
                    $s = $item->stock;
                    $p = $item->precio;
                    $i = $item->id;
                    $obj = new  producto($c,$n,$t,$s,$p,$i);
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
                {//id,codigo,nombre,tipo,stock,precio,fechaDeCreacion,ultimamodificacion
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
    {//id,codigo,nombre,tipo,stock,precio,fechaDeCreacion,ultimamodificacion
        if($obj->_nombre!=null && $obj->_stock!=null && $obj->_id!=null)
        {
            $l = array();
            $l = usuario::_CargaLista($a);
            foreach ($l as $item) 
            {
                if($item->_codigo != $obj->_codigo && $item->_id != $obj->_id)
                {
                    $msg = "\n".$obj->codigo.",".$obj->nombre.",".$obj->tipo.",".$obj->stock.",".$obj->precio.",".$obj->id.";";
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
    
}
?>
