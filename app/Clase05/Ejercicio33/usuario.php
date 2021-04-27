<?php
include_once "archivo.php";


class usuario
{
    public $nombre;
    public $apellido;
    public $clave;
    public $mail;
    public $fechaRegistro;
    public $id;
    public $localidad;
    //nombre,apellido,clave,mail,feReg,id,localidad
    public function __construct(){}
    
    #region Propias
    public function _setUsuario($i, $n, $a, $c, $m, $f, $l)
    { 
        $this->id = $i;
        $this->nombre = $n;
        $this->apellido = $a;
        $this->clave = $c;
        $this->mail = $m;
        $this->fechaRegistro = $f;
        $this->localidad=$l;
    }    
    
    static function _validarLogin($m, $c, $l)
    {
        if($l != null)
        {
            foreach ($l as $item)
            {
                if($item->mail == $m & $item->clave == $c)
                {
                    return "Verificado!";
                }
                if($item->mail == $m & $item->clave != $c)
                {
                    return "Error en los datos!";
                }
                if($item->mail != $m & $item->clave == $c)
                {
                    return "Usuario no registrado!";
                }            
            }
        }
        else
        {
            return "Se pudrio la momia";
        }
    }

    static function _validarUsuario($obj, $a)
    {
        $key = "1234";
        $root = "admin";
                
        //$u->_ToString();        
        if($obj->nombre!=null && $obj->mail!=null && $obj->clave!=null)
        {            
            $l = array();
            $l = usuario::_CargaLista($a);
            //usuario::_ImprimirLista($l);
            //$u->_ToString();
            if(strcmp($obj->nombre, $root) ==0 && strcmp($obj->clave, $key)==0)
            {
                return "Bienvenido ADMIN<br/>";
            }
            else
            {
                foreach ($l as $item) 
                {   
                    if($item->nombre== $obj->nombre)

                    if(strcmp($item->nombre, $obj->nombre) ==0 
                    && strcmp($item->clave, $obj->clave) ==0)
                    {
                        return "Verificado!";
                    }
                    if(strcmp($item->clave, $obj->clave) !=0)
                    {
                        return "Error en los datos!";
                    } 
                    if(strcmp($item->mail, $obj->mail) !=0)
                    {
                        return "Usuario no registrado!";
                    }   
                }//var_dump($t);
            }
            return "que carajo!?!";
        }
        else
        {
            return "Faltan datos!";
        }
    }   

    static function _VerificarUsuarioPorId($id,$lista)
    {
        foreach ($lista as $item) 
        {
            if($item->id == $id)
            {
                return true;
            }
            return false;
        }
    }

    public function _ToString()
    {//nombre apellido clave mail feReg localidad
        $mensaje = "ID: ".$this->id."<br/>".
                   "Nombre: ".$this->nombre."<br/>".
                   "Apellido: ".$this->apellido."<br/>".
                   "Mail: ".$this->mail."<br/>".
                   "Clave: ".$this->clave."<br/>".
                   "Localidad: ".$this->localidad."<br/>".
                   "Fecha Registro: ".$this->fechaRegistro."<br/><br/>";        
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
                echo "<li>".$item->id."</li>";
                echo "<li>".$item->nombre." ".$item->apellido."</li>";
                echo "<li>".$item->mail."</li>";
                //echo "<li>".$item->_clave."</li>";
                echo "<li>".$item->localidad."</li>";
                echo "</ul>";
                ////////////////////////////////////// "formato csv"
                // $path = "Usuarios/Fotos/".$item->nombre.".png";
                // echo "<ul>"."<br/>";
                // echo "<li>".$item->nombre."/".$item->mail."/".$item->feReg."/".$item->id."/"."<img src=\"$path\">"."</li>";
                // echo "</ul>";
            }
        }
        else
        {
            echo "Error en la lista";
        }
    }

    public function _cambioDeClave($nombre, $mail, $claveNueva, $claveVieja)
    {
        $l = Array();
        $l = usuario::_SelectAll();
        foreach ($l as $item) 
        {
            if($item->nombre == $nombre && $item->mail == $mail && $item->clave == $claveVieja)
            {
                $item->clave = $claveNueva;
                //$item->_Update();
                $item->_ToString();
                return true;
            }        
        }
        return false;

    }
    
    #endregion
    #region DB
    public function _Insert()
	{//nombre apellido clave mail feReg localidad
        $objetoAccesoDato = archivo::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into personas 
        (nombre,apellido,clave, mail,fechaRegistro,localidad)
        values(:nombre,:apellido,:clave,:mail,:fechaRegistro,:localidad)");
        $consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':apellido',$this->apellido, PDO::PARAM_STR);
        $consulta->bindValue(':clave',$this->clave, PDO::PARAM_STR);
        $consulta->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $consulta->bindValue(':fechaRegistro', $this->fechaRegistro, PDO::PARAM_STR);
        $consulta->bindValue(':localidad', $this->localidad, PDO::PARAM_STR);
        $consulta->execute();		
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    public function _Delete()
    {
        $objetoAccesoDato = archivo::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("DELETE FROM personas 				
        WHERE id=:id");	
        $consulta->bindValue(':id',$this->id, PDO::PARAM_INT);		
        $consulta->execute();
        return $consulta->rowCount();
    }

    public function _Update()
    {///nombre apellido clave mail feReg localidad
        $objetoAccesoDato = archivo::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE personas 
        SET nombre=:nombre, apellido=:apellido, clave=:clave, mail=:mail, fechaRegistro=:fechaRegistro, localidad=:localidad
        WHERE id=:id");
        $consulta->bindValue(':id',$this->id, PDO::PARAM_INT);
        $consulta->bindValue(':apellido',$this->apellido, PDO::PARAM_STR);
        $consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
        $consulta->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $consulta->bindValue(':fechaRegistro', $this->fechaRegistro, PDO::PARAM_STR);
        $consulta->bindValue(':localidad', $this->localidad, PDO::PARAM_STR);
        $consulta->execute();
        return $this;
    }

    static function _SelectAll()//NO FUNCA//AHORA SI:p
    {//nombre,apellido,clave,mail,feReg,id,localidad
        $l = array();
        $objetoAccesoDato = archivo::dameUnObjetoAcceso(); 
        /*$consulta =$objetoAccesoDato->RetornarConsulta("SELECT 
        nombre AS nombre, apellido AS apellido, clave AS clave, mail AS mail, fechaRegistro AS feReg, id AS id, localidad AS localidad
        FROM personas");*/
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT* FROM personas");
        $consulta->execute();			
        $l = $consulta->fetchAll(PDO::FETCH_CLASS, "usuario");
        return $l;
        //var_dump($l);
	}

    #endregion
    #region JSON
    static function _PersistirJSON($obj, $a)
    {
        if($obj->nombre!=null && $obj->mail!=null && $obj->clave!=null && $obj->fechaRegistro!=null && $obj->id!=null)
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
                    $n = $item->nombre;
                    $c = $item->clave;
                    $m = $item->mail;
                    $f = $item->fechaRegistro;
                    $i = $item->id;
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
        if($obj->nombre!=null && $obj->mail!=null && $obj->clave!=null)
        {
            $l = array();
            $l = usuario::_CargaLista($a);
            foreach ($l as $item) 
            {
                if($item->nombre != $obj->nombre && $item->clave != $obj->clave && $item->mail != $obj->mail)
                {
                    $msg = "\n".$obj->nombre.",".$obj->mail.",".date("Y/m/d").";";
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
