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
    
    public function _ToString()
    {
        $mensaje = "Nombre: ".$this->_nombre."<br/>"."Mail: ".$this->_mail."<br/>"."Clave: ".$this->_clave."<br/><br/>";        
        echo "DATOS DEL USUARIO: <br/>".$mensaje;
    }
    
    static function _validarUsuario($usuario)
    {
        $estado=null;
        $mensaje=null; 
                
        if(isset($usuario->_nombre) && isset($usuario->_clave) && isset($usuario->_mail))
	    {
            if($usuario->_nombre == "admin" && $usuario->_clave == "1234")
            {
                $estado = "OK";               
            }
            else
            {
                $estado =  "USUARIO NO REGISTRADO";
            }
        }
        else
        {
            $estado =  "faltan datos";
        }
        $mensaje = $usuario->_nombre.",".$usuario->_mail.",".date("Y/m/d")." ;\n";

        echo archivos::_guardarCsv($mensaje); 
    }
}
?>
