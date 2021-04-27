<?php
include "archivo.php";
include "AccesoDatos.php";

class usuario
{
    public $_nombre;
    public $_apellido;
    public $_clave;
    public $_mail;
    public $_feReg;
    public $_id;
    public $_localidad;
    
    #region Propias
    public function __construct(){}
    
    public function _usuarioConId($i, $n, $a, $c, $m, $f, $l)
    { 
        $this->_id = $i;
        $this->_nombre = $n;
        $this->_apellido = $a;
        $this->_clave = $c;
        $this->_mail = $m;
        $this->_feReg = $f;
        $this->_localidad=$l;
    }    
    
    public function _usuario($n, $a, $c, $m, $f, $l)
    {
        $this->_nombre = $n;
        $this->_apellido = $a;
        $this->_clave = $c;
        $this->_mail = $m;
        $this->_feReg = $f;
        $this->_localidad=$l;
    }

    public static function _validarLogin($m, $c, $l)
    {
        if($m!=null && $c!=null && $l!=null)
        {
            foreach ($l as $item) 
            {
                if($item->_mail == $m && $item->_clave == $c)
                {
                    return "Verificado";
                }
                if($item->_mail == $m && $item->_clave != $c) 
                {
                    return "Error en los datos";
                }
                if($item->_mail != $m && $item->_clave == $c) 
                {
                    return "Usuario no registrado";
                }
                else
                {
                    return "Error!";
                }
            }
        }
    }

    static function _validarUsuario($obj, $a)
    {
        $key = "1234";
        $root = "admin";
                
        //$u->_ToString();        
        if($obj->_nombre!=null && $obj->_mail!=null && $obj->_clave!=null)
        {            
            $l = array();
            $l = usuario::_CargaLista($a);
            //usuario::_ImprimirLista($l);
            //$u->_ToString();
            if(strcmp($obj->_nombre, $root) ==0 && strcmp($obj->_clave, $key)==0)
            {
                return "Bienvenido ADMIN<br/>";
            }
            else
            {
                foreach ($l as $item) 
                {   
                    if(strcmp($item->_nombre, $obj->_nombre) ==0 
                    && strcmp($item->_clave, $obj->_clave) ==0)
                    {
                        return "Verificado!";
                    }
                    if(strcmp($item->_clave, $obj->_clave) !=0)
                    {
                        return "Error en los datos!";
                    } 
                    if(strcmp($item->_mail, $obj->_mail) !=0)
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
    {//nombre apellido clave mail feReg localidad
        $mensaje = "ID: ".$this->_id."<br/>".
                    "Nombre: ".$this->_nombre."<br/>".
                    "Apellido: ".$this->_apellido."<br/>".
                    "Mail: ".$this->_mail."<br/>".
                    "Localidad: ".$this->_localidad."<br/>".
                    "Fecha Registro: ".$this->_feReg."<br/><br/>";        
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
                echo "<ul>"."<br/>";
                echo "<li>".$item->_nombre."</li>";
                echo "<li>".$item->_mail."</li>";
                echo "<li>".$item->_clave."</li>";
                echo "</ul>";
                ////////////////////////////////////// "formato csv"
                // $path = "Usuarios/Fotos/".$item->_nombre.".png";
                // echo "<ul>"."<br/>";
                // echo "<li>".$item->_nombre."/".$item->_mail."/".$item->_feReg."/".$item->_id."/"."<img src=\"$path\">"."</li>";
                // echo "</ul>";
            }
        }
        else
        {
            echo "Error en la lista";
        }
    }    
    #endregion
    #region DB
    public static function _SelectAll()//NO FUNCA
    {
        $l = array();
        $objetoAccesoDato = archivo::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * from personas");
        $consulta->execute();			
        $l = $consulta->fetchAll(PDO::FETCH_CLASS, "usuario");
        return $l;
	}

    public function _Insert()
	{//nombre apellido clave mail feReg localidad
        $objetoAccesoDato = archivo::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into personas 
        (nombre,apellido,clave, mail,fechaRegistro,localidad)
        values(:nombre,:apellido,:clave,:mail,:fechaRegistro,:localidad)");
        $consulta->bindValue(':nombre',$this->_nombre, PDO::PARAM_STR);
        $consulta->bindValue(':apellido',$this->_apellido, PDO::PARAM_STR);
        $consulta->bindValue(':clave',$this->_clave, PDO::PARAM_STR);
        $consulta->bindValue(':mail', $this->_mail, PDO::PARAM_STR);
        $consulta->bindValue(':fechaRegistro', $this->_feReg, PDO::PARAM_STR);
        $consulta->bindValue(':localidad', $this->_localidad, PDO::PARAM_STR);
        $consulta->execute();		
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    
    #endregion
    #region JSON
    static function _PersistirJSON($obj, $a)
    {
        if($obj->_nombre!=null && $obj->_mail!=null && $obj->_clave!=null && $obj->_feReg!=null && $obj->_id!=null)
        {
            $l = array();     
            $msg = json_encode($obj);
            //echo $msg;
            archivo::_GuardarJSON($msg, $a);
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
            $contenido = archivo::_CargarJSON($archivo);
            if($contenido!=null)
            {
                foreach ($contenido as $item) 
                {       
                    $n = $item->_nombre;
                    $c = $item->_clave;
                    $m = $item->_mail;
                    $f = $item->_feReg;
                    $i = $item->_id;
                    $obj = new  usuario($n,$c,$m,$f,$i);
                    array_push($lista, $obj);
                }
            }
        }
        return $lista;
    }
    #endregion
    #region CSV
    static function _CargaListaCSV($archivo)
    {
        $lista=array();
        if($archivo!=null)
        {
            $lineas = archivo::_CargarCsv($archivo);
            if($lineas!=null)
            {
                for ($i=0; $i <count($lineas) ; $i++) 
                { 
                    $ats = explode(",",$lineas[$i]);
                    $n = $ats[0];
                    $m = $ats[1];
                    $c = $ats[2];
                    $obj = new  usuario($n,$c,$m);
                    array_push($lista, $obj);
                }
            }
        }
        return $lista;
    }   

    static function _PersistirCsv($obj, $a)
    {
        if($obj->_nombre!=null && $obj->_mail!=null && $obj->_clave!=null)
        {
            $l = array();
            $l = usuario::_CargaLista($a);
            foreach ($l as $item) 
            {
                if($item->_nombre != $obj->_nombre && $item->_clave != $obj->_clave && $item->_mail != $obj->_mail)
                {
                    $msg = "\n".$obj->_nombre.",".$obj->_mail.",".date("Y/m/d").";";
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
