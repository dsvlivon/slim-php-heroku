<?php
include "archivos.php";

class usuario
{
    public $_nombre;
    public $_clave;
    public $_mail;
    
    public function __construct($n,$c,$m)
    {
        $this->_nombre = $n;
        $this->_clave = $c;
        $this->_mail = $m;
    }    

    static function _CargaLista($archivo)
    {
        $listaU=array();
        if($archivo!=null)
        {
            $lineas = archivos::_CargarCsv($archivo);
            if($lineas!=null)
            {
                for ($i=0; $i <count($lineas) ; $i++) 
                { 
                    $ats = explode(",",$lineas[$i]);
                    $n = $ats[0];
                    $m = $ats[1];
                    $c = $ats[2];
                    $u = new  usuario($n,$c,$m);
                    array_push($listaU, $u);
                }
            }
        }
        return $listaU;
    }
    
    public function _ToString()
    {
        $mensaje = "Nombre: ".$this->_nombre."<br/>"."Mail: ".$this->_mail."<br/>"."Clave: ".$this->_clave."<br/><br/>";        
        echo "DATOS DEL USUARIO: <br/>".$mensaje;
    }

    static function _ImprimirLista($l)
    {
        if(is_array($l))
        {          
            foreach ($l as  $item) 
            {
                echo "<ul>"."<br/>";
                echo "<li>".$item->_nombre."</li>";
                echo "<li>".$item->_mail."</li>";
                echo "<li>".$item->_clave."</li>";
                echo "</ul>";
                //echo $item->_ToString();
            }
        }
        else
        {
            echo "Error en la lista";
        }
    }

    static function _Persistir($u)
    {
        if($u->_nombre!=null && $u->_mail!=null && $u->_clave!=null)
        {
            $msg = "\n".$u->_nombre.",".$u->_mail.",".date("Y/m/d").";";
            archivos::_GuardarCsv($msg);
        }
    }
    
    static function _validarUsuario($u)
    {
        $estado=null;
        $mensaje=null; 
        $key = "1234";
        $root = "admin";
                
        //if(isset($u->_nombre) && isset($u->_clave) && isset($u->_mail))
	    if($u->_nombre!=null && $u->_mail!=null && $u->_clave!=null)
        {
            if($u->_nombre == $root && $u->_clave == $key)
            {
                $estado =  1;               
            }
            else
            {
                $estado = 2;
            }
        }
        else
        {
            $estado =  0;
        }

        return $estado; 
    }
}
?>
