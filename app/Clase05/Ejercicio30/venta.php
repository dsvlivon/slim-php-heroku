<?php
include "archivo.php";
include "producto.php";
include "usuario.php";

class venta
{   
    public $codigoProducto;
    public $cantidad;
    public $idUsuario;
    public $idVenta;

    
    public function __construct(){}
    
    public function _setVenta($c, $q, $u, $v)
    {
        $this->codigoProducto = $c;
        $this->cantidad = $q;
        $this->idUsuario = $u;
        $this->idVenta = $v;
    }


    public function _Vender($aUsuarios, $aProductos)
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
                    $obj = new  venta($c,$q,$u,$v);
                    array_push($lista, $obj);
                }
            }
        }
        return $lista;
    }  


}
?>
