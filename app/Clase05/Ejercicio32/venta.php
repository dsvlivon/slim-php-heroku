<?php
include_once "archivo.php";
include_once "producto.php";
include_once "usuario.php";

class venta
{   
    public $id;
    public $idProducto;
    public $idUsuario;
    public $cantidad;
    public $fechaVenta;
    //idProducto,idUsuario,,cantidad,fechaVenta
    public function __construct(){}
    
    #region Propias
    public function _setVenta($p, $q, $u)
    {//idProducto,idUsuario,,cantidad,fechaVenta
        $this->idProducto = $p;
        $this->cantidad = $q;
        $this->idUsuario = $u;
        $this->fechaVenta = date("Y/m/d");
        //$this->id = $i;
    }

    public function _VenderDB()
    {
        $flag = false;
        $listaProductos;
        $listaUsuarios ;

        $listaVentas = venta::_SelectAll();
        $listaUsuarios = usuario::_SelectAll();
        $listaProductos = producto::_SelectAll();

        $flag = usuario::_VerificarUsuarioPorId($this->idUsuario, $listaUsuarios);
        $flag = producto::_VerificarExistencia($this->idProducto, $this->cantidad, $listaProductos);

        if($flag == true)
        {
            foreach ($listaProductos as $item) 
            {
                if($this->idProducto == $item->id)
                {
                    
                    echo "LLEGO... BIEN DANIEL NO SOS TAN PELOTUDO";
                    $item->stock-=$this->cantidad;
                    echo ($item->_Update())->_ToString();
                    return "venta realizada";//Se hizo una venta
                }
            }            
        }
        return "no se pudo hacer";//“si no se pudo hacer      
    }
    
    public function _VenderJSON($aUsuarios, $aProductos)
    {
        $flag = false;
        $listaProductos;
        $listaUsuarios ;

        $listaVentas = venta::_CargarListaJSON("ventas.json");
        $listaUsuarios = usuario::_CargarListaJSON($aUsuarios);
        $listaProductos = producto::_CargarListaJSON($aProductos);

        $flag = usuario::_VerificarUsuarioPorId($this->idUsuario,$listaUsuarios);
        $flag = producto::_VerificarProducto($this->codigoProducto,$this->cantidad,$listaProductos);

        if($flag == true)
        {
            foreach ($listaProductos as $item) 
            {
                if($this->codigoProducto == $item->codigo)
                {
                    $item->stock-=$this->cantidad;
                }
            }
            archivos::_GuardarArray($listaProductos,"productos.json");
            array_push($listaVentas, $this);
            return "venta realizada";//Se hizo una venta
        }
        return "no se pudo hacer";//“si no se pudo hacer      
    }    
    
    #endregion
    #region DB
    public function _Insert()
	{//idProducto,idUsuario,cantidad,fechaVenta
        $objetoAccesoDato = archivo::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO ventas 
        (idProducto,idUsuario,cantidad,fechaVenta) VALUES(:idProducto,:idUsuario,:cantidad,:fechaVenta)");
        $consulta->bindValue(':idProducto',$this->idProducto, PDO::PARAM_INT);
        $consulta->bindValue(':idUsuario',$this->idUsuario, PDO::PARAM_INT);
        $consulta->bindValue(':cantidad',$this->cantidad, PDO::PARAM_INT);
        $consulta->bindValue(':fechaVenta',$this->fechaVenta, PDO::PARAM_STR);
        
        $consulta->execute();		
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    public function _Delete()
    {
        $objetoAccesoDato = archivo::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("DELETE FROM ventas 				
        WHERE id=:id");	
        $consulta->bindValue(':id',$this->id, PDO::PARAM_INT);		
        $consulta->execute();
        return $consulta->rowCount();
    }

    public function _Update()
    {//idProducto,idUsuario,cantidad,fechaVenta
        $objetoAccesoDato = archivo::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE productos 
        SET idProducto=:idProducto, idUsuario=:idUsuario, cantidad=:cantidad, fechaVenta=:fechaVenta WHERE id=:id");
        $consulta->bindValue(':id',$this->id, PDO::PARAM_INT);
        $consulta->bindValue(':idProducto',$this->idProducto, PDO::PARAM_INT);
        $consulta->bindValue(':idUsuario',$this->idUsuario, PDO::PARAM_INT);
        $consulta->bindValue(':cantidad',$this->cantidad, PDO::PARAM_INT);
        $consulta->bindValue(':fechaVenta', $this->fechaVenta, PDO::PARAM_STR);
        
        $consulta->execute();
        return $this;
    }

    static function _SelectAll()
    {//codigoProducto,cantidad,idUsuario,id
        $l = array();
        $objetoAccesoDato = archivo::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM ventas");
        $consulta->execute();			
        $l = $consulta->fetchAll(PDO::FETCH_CLASS, "venta");
        return $l;
	}

    #endregion
    #region JSON
    static function _CargarListaJSON($archivo)
    {
        $lista=array();
        if($archivo!=null)
        {
            $contenido = archivo::_CargarJSON($archivo);
            if($contenido!=null)
            {
                foreach ($contenido as $item) 
                {       
                    $c = $item->codigoProducto;
                    $q = $item->cantidad;
                    $u = $item->idUsuario;
                    $v = $item->idVenta;
                    $obj = new venta($c,$q,$u,$v);
                    array_push($lista, $obj);
                }
            }
        }
        return $lista;
    }
    #endregion


}
?>
