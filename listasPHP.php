<?php
//*************Array LIst en php***********


//Creacion de un arreglo vacio
$seme1 = array();


//agregar al arreglo
array_push($seme1,$nRow[3]);//Con esta funcion añades al arreglo (arraynombre, "cosa agregar")

//Mostrarlos
echo "<h1>Semestre 1</h1>";
for($i=0; $i<count($seme1); $i++ ){//Funcion count "cuenta cuantos elementos son"
    echo  "<h1>$seme1[$i]</h1>";
}

?>