<?php
include "archivo.php";
include "producto.php";
include "usuario.php";

class venta
{   
    public $_codigoProducto;
    public $_cantidad;
    public $_idUsuario;
    public $_idVenta;

    public function __construct($c, $q, $u, $v)
    {
        $this->_codigoProducto = $c;
        $this->_cantidad = $q;
        $this->_idUsuario = $u;
        $this->_idVenta = $v;
    }


    public function _Vender($aUsuarios, $aProductos)
    {
        $flag = false;
        $listaProductos;
        $listaUsuarios ;

        $listaVentas = venta::_CargarListaJSON("ventas.json");
        $listaUsuarios = usuario::_CargarListaJSON($aUsuarios);
        $listaProductos = producto::_CargarListaJSON($aProductos);

        $flag = usuario::_VerificarUsuarioPorId($this->_idUsuari,$listaUsuarios);
        $flag = producto::_VerificarProducto($this->_codigoProducto,$this->_cantidad,$listaProductos);

        if($flag == true)
        {
            foreach ($listaProductos as $item) 
            {
                if($this->_codigoProducto == $item->_codigo)
                {
                    $item->_stock-=$this->_cantidad;
                }
            }
            archivos::_GuardarArray($listaProductos,"productos.json");
            array_push($listaVentas, $this);
            return "venta realizada";//Se hizo una venta
        }
        return "no se pudo hacer";//“si no se pudo hacer
      
    }    
    
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
                    $c = $item->_codigoProducto;
                    $q = $item->_cantidad;
                    $u = $item->_idUsuario;
                    $v = $item->_idVenta;
                    $obj = new  venta($c,$q,$u,$v);
                    array_push($lista, $obj);
                }
            }
        }
        return $lista;
    }  


}
?>
