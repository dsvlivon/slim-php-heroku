<?php
/***********************************
VIZGARRA.LIVON.DANIEL
Aplicación No 15 (Figuras geométricas)
***********************************/
include "FiguraGeometrica.php";

//class  Triangulo extends AnotherClass implements Interface (IMPLEMENTA INTERFACE)
class Triangulo extends FiguraGeometrica
{
    var $_altura;
    var $_base;

    public function _construct($b, $a)
    {
        parent::__construct();//asi se hereda el constructor del base
        $this->_altura = $a;
        $this->_base = $b;
        $this->CalcularDatos();
    }

    protected function CalcularDatos()
    {
        $this->_perimetro = $this->_base + $this->_altura*2;
        $this->_superficie = $this->_base * $this->_altura/2; 
    }

    public function Dibujar()
    {
        $color = $this->GetColor();
        $retorno = "<p style=color:$color;>";
        $base = $this->_base;    
        $altura = $this->_altura;
        $espacios = $altura;
        $asteriscos = 1;

        for ($i=0; $i < $altura; $i++) {
            for ($j=0; $j < $espacios-1; $j++) {
                $retorno .= "&nbsp;&nbsp;";
                //$retorno .= "+";
            }
            for ($j=0; $j < $asteriscos; $j++) {
                $retorno .= "*";
            }
            $espacios--;
            $asteriscos+=2;
            $retorno .= "<br>";
        }
        
        $retorno.= "</p>";
        return $retorno;
    }

    public function __ToString()
    {
        return parent::__ToString()."Base: ".$this->_base."<br>Altura: ".$this->_altura.$this->Dibujar();
    }
}

