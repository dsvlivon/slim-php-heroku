<?php
/***********************************
VIZGARRA.LIVON.DANIEL
Aplicación No 15 (Figuras geométricas)
***********************************/
include "FiguraGeometrica.php";

class Rectangulo extends FiguraGeometrica
{
    var $_ladoUno;
    var $_ladoDos;//ACA OTRA VEZ M OLVIDE EL PUTO "_"

    public function __construct($l1, $l2)
    {
        parent::__construct();//asi se hereda el constructor del base
        $this->_ladoUno = $l1;
        $this->_ladoDos = $l2;
        $this->CalcularDatos();
    }
    protected function CalcularDatos()
    {
        $this->_perimetro = $this->_ladoUno*2 + $this->_ladoDos*2;
        $this->_superficie = $this->_ladoUno*$this->_ladoDos;
    }

    public function Dibujar()//REVISAR
    {
        $color = $this->GetColor();
        $retorno = "<p style=color:$color;>";
        $columnas = $this->_ladoUno;
        $filas = $this->_ladoDos;

        for ($j=0; $j < $filas ; $j++) {             
            for ($i=0; $i < $columnas; $i++) { 
                // if($i == 0 || $i == $columnas-1 || $j == 0 || $j == $filas - 1){
                //     $retorno .= "*";
                // }
                // else{
                //     $retorno .= "&nbsp;&nbsp;";
                // }
                $retorno .= "*";
            }         
            $retorno .= "<br>";
        }
        $retorno.= "</p>";
        return $retorno;
    }

    public function ToString()
    {
        return parent::ToString()."Altura: ".$this->_ladoDos."<br>Ancho: ".$this->_ladoUno.$this->Dibujar();
    }//ASI SE POLIMORFA UNA FUNCION, DIRECTO EN EL RETURN VA "parent::"

}
