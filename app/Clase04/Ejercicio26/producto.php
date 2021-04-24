<?php
include "archivos.php";

class producto
{
    /*$c = $_POST["codigo"];
    $n = $_POST["nombre"];
    $t = $_POST["tipo"];
    $s = $_POST["stock"];
    $p = $_POST["precio"];
    $i = rand(0,10000);
    $prod = new producto($c,$n,$t,$s,$p,$i);*/

    public $_nombre;
    public $_codigo;
    public $_tipo;
    public $_stock;
    public $_precio;
    public $_id;
    //$prod = new producto($c,$n,$t,$s,$p,$i);
    public function __construct($c,$n,$t,$s,$p,$i)
    {
        $this->_nombre = $n;
        $this->_codigo = $c;
        $this->_tipo = $t;
        $this->_stock = $s;
        $this->_precio = $p;
        $this->_id = $i;
    }    

    static function _CargaListaCSV($a)
    {
        $listaU=array();
        if($a!=null)
        {
            $lineas = archivos::_CargarCsv($a);
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
                    array_push($listaU, $obj);
                }
            }
        }
        return $listaU;
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
                    archivos::_GuardarCsv($msg, $a);
                }    
            }            
        }
        else
        {
            echo "Faltan Datos";
        }
    }
    
    static function _PersistirJSON($obj, $a)
    {
        if($obj->_codigo!= null && $obj->_id!=null)
        {    
            $msg = json_encode($obj);
            //echo $msg;
            archivos::_GuardarJSON($msg, $a);
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
            $contenido = archivos::_CargarJSON($a);
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

    /*static function _GenerarId()
    {
        $l = array();
        $l = usuario::_CargaLista("usuarios.csv");

        for($i=0, $i<count($l),$i++) 
        {
            if(l[$i]._id==0)
            {
                if(l[$i]._id < l[$i+1]._id)
                {
                    
                }
            }    
            else{$id=0;}
        }
    
        return $id;
    }*/
    
    static function _VerificarProducto($codigo, $cantidad, $lista)
    {
        foreach ($lista as $item) 
        {
            if($item->_codigo == $codigo && $item->_stock >=$cantidad)
            {
                return true;
            }
        }
        return false;
    }
    //producto::_VerificarProducto($codVenta,$cantidad);

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
                archivos::_GuardarArray($l, $a);
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
}
?>
