<?php
include "archivos.php";
include "AccesoDatos.php";

class usuario
{
    public $_nombre;
    public $_clave;
    public $_mail;
    public $_feReg;
    public $_id;
    public $_localidad;
    
    public function __construct($n, $a, $c, $m, $f, $l)
    { //nombre apellido clave mail feReg localidad
        $this->_nombre = $n;
        $this->_apellido = $a;
        $this->_clave = $c;
        $this->_mail = $m;
        $this->_feReg = $f;
        //$this->_id = $i;
        $this->_localidad=$l;
    }    

    public static function TraerTodoLosCds()
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id,titel as titulo, interpret as cantante,jahr as año from cds");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "cd");		
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
        if($u->_nombre!=null && $u->_mail!=null && $u->_clave!=null && $u->_feReg!=null && $u->_id!=null)
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
        $listaU=array();
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
                    $f = $item->_feReg;
                    $i = $item->_id;
                    $u = new  usuario($n,$c,$m,$f,$i);
                    array_push($listaU, $u);
                }
            }
        }
        return $listaU;
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
    
    static function _validarUsuario($u, $a)
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
    {//nombre apellido clave mail feReg localidad
        $mensaje = "Nombre: ".$this->_nombre."<br/>".$this->_apellido."<br/>".
        "Mail: ".$this->_mail."<br/>"."Localidad: ".$this->_localidad."<br/><br/>";        
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
                echo "<li>".$item->_nombre."/".$item->_mail."/".$item->_feReg."/".$item->_id."/"."<img src=\"$path\">"."</li>";
                echo "</ul>";
            }
        }
        else
        {
            echo "Error en la lista";
        }
    }

    public function _PersistirDB()
	{//nombre apellido clave mail feReg localidad
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
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
}
?>
