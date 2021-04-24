<?php
include "archivos.php";

class usuario
{
    public $_nombre;
    public $_clave;
    public $_mail;
    public $_fecha;
    public $_id;
    
    public function __construct($n,$c,$m,$f,$i)
    {
        $this->_nombre = $n;
        $this->_clave = $c;
        $this->_mail = $m;
        $this->_fecha = $f;
        $this->_id = $i;
    }    

    static function _CargaListaCSV($archivo)
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

    static function _PersistirCsv($u, $a)
    {
        if($u->_nombre!=null && $u->_mail!=null && $u->_clave!=null)
        {
            $l = array();
            $l = usuario::_CargaLista($a);
            foreach ($l as $t) 
            {
                if($t->_nombre != $u->_nombre && $t->_clave != $u->_clave && $t->_mail != $u->_mail)
                {
                    $msg = "\n".$u->_nombre.",".$u->_mail.",".date("Y/m/d").";";
                    archivos::_GuardarCsv($msg, $a);
                }    
            }            
        }
        else
        {
            echo "Faltan Datos";
        }
    }
    
    static function _PersistirJSON($u, $a)
    {
        if($u->_nombre!=null && $u->_mail!=null && $u->_clave!=null && $u->_fecha!=null && $u->_id!=null)
        {
            $l = array();     
            $msg = json_encode($u);
            //echo $msg;
            archivos::_GuardarJSON($msg, $a);
        }
        else
        {
            echo "Faltan Datos";
        }
    }

    static function _CargaListaJSON($archivo)
    {
        $lista=array();
        if($archivo!=null)
        {
            $contenido = archivos::_CargarJSON($archivo);
            if($contenido!=null)
            {
                foreach ($contenido as $item) 
                {       
                    $n = $item->_nombre;
                    $c = $item->_clave;
                    $m = $item->_mail;
                    $f = $item->_fecha;
                    $i = $item->_id;
                    $obj = new  usuario($n,$c,$m,$f,$i);
                    array_push($lista, $obj);
                }
            }
        }
        return $lista;
    }

    static function _VerificarUsuarioPorId($id,$lista)
    {
        foreach ($lista as $item) 
        {
            if($item->_id == $id)
            {
                return true;
            }
            return false;
        }
    }

    static function _validarUsuarioPor($u, $a)
    {
        $key = "1234";
        $root = "admin";
                
        //$u->_ToString();        
        if($u->_nombre!=null && $u->_mail!=null && $u->_clave!=null)
        {            
            $l = array();
            $l = usuario::_CargaLista($a);
            //usuario::_ImprimirLista($l);
            //$u->_ToString();
            if(strcmp($u->_nombre, $root) ==0 && strcmp($u->_clave, $key)==0)
            {
                return "Bienvenido ADMIN<br/>";
            }
            else
            {
                foreach ($l as $t) 
                {
                    if(strcmp($t->_nombre, $u->_nombre) ==0 
                    && strcmp($t->_clave, $u->_clave) ==0)
                    {
                        return "Verificado!";
                    }
                    if(strcmp($t->_clave, $u->_clave) !=0)
                    {
                        return "Error en los datos!";
                    } 
                    if(strcmp($t->_mail, $u->_mail) !=0)
                    {
                        return "Usuario no registrado!";
                    }   
                }
                //var_dump($t);
            }
            return "que carajo!?!";
        }
        else
        {
            return "Faltan datos!";
        }
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
                //echo $item->_ToString();
                ////////////////////////////////////// "lo normal"
                // echo "<ul>"."<br/>";
                // echo "<li>".$item->_nombre."</li>";
                // echo "<li>".$item->_mail."</li>";
                // echo "<li>".$item->_clave."</li>";
                // echo "</ul>";
                ////////////////////////////////////// "formato csv"
                $path = "Usuarios/Fotos/".$item->_nombre.".png";
                echo "<ul>"."<br/>";
                echo "<li>".$item->_nombre."/".$item->_mail."/".$item->_fecha."/".$item->_id."/"."<img src=\"$path\">"."</li>";
                echo "</ul>";
            }
        }
        else
        {
            echo "Error en la lista";
        }
    }
}
?>
