<?php
/***********************************
VIZGARRA.LIVON.DANIEL
Aplicación No 15 (Figuras geométricas)
***************/

abstract class FiguraGeometrica
{
    /*Constructor
    public function __construct() 
    { 
        // código 
    }*/ 
    protected $_color;
    protected $_perimetro;
    protected $_superficie;


    public function _construct()
    {
        $this->_color = "BLANCO";
        $this->_perimetro = 0;
        $this->_superficie = 0;
    }

    protected abstract function CalcularDatos();//dibujo d llave en uml = protected

    public abstract function Dibujar();

    public function GetColor()//hace falta declarar el tipo de retorno?
    
    {
        return $this->_color;//NO OLVIDAR LOS PUTOS GUION BAJO!
    }

    public function SetColor(string $color)
    {
        $this->_color = $color;
    }

    public function ToString()
    {
        return "Color: ".$this->GetColor()."<br>Perimetro: ".$this->_perimetro."<br>Superficie: ".$this->_superficie."<br>";
    }

    /*//Métodos.
    private function Func1($param) 
    { //código }
    protected function Func2() 
    { //código }
    public function Func3() 
    { //código }
    public static function Func4() 
    { //código }*/
}

?>