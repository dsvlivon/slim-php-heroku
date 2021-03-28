<?php
/***********************************
VIZGARRA.LIVON.DANIEL
Aplicación No 15 (Figuras geométricas)
La clase FiguraGeometrica posee: todos sus atributos protegidos, un constructor por defecto,
un método getter y setter para el atributo _color, un método virtual (ToString) y dos
métodos abstractos: Dibujar (público) y CalcularDatos (protegido).
CalcularDatos será invocado en el constructor de la clase derivada que corresponda, su
funcionalidad será la de inicializar los atributos _superficie y _perimetro.
Dibujar, retornará un string (con el color que corresponda) formando la figura geométrica del
objeto que lo invoque (retornar una serie de asteriscos que modele el objeto).
Ejemplo:
  *   *******
 ***  *******
***** *******
***********************************/

//require "FiguraGeometrica";
require "FiguraGeometrica.php";
require "Rectangulo.php";
require "Triangulo.php";

echo "Mmm ... intento uno d q ande!";

$triangulo = new Triangulo(5, 3);
echo($triangulo);


$rectangulo = new Rectangulo(15, 4);
$rectangulo->SetColor("red");
echo($rectangulo);

$trinagulo->SetColor("red");
echo($triangulo);
$rec->SetColor("green");
echo($rectangulo);

?>