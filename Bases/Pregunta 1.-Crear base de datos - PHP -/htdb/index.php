<?php

include "htdb.php";

$conexion = new HTDB("crm");
//$conexion->peticion("CREATE TABLE clientes (id,nombre,apellidos,email,telefono)");
//$conexion->peticion('INSERT INTO clientes VALUES("4","Alberto","Albal","hector@gmail.com","3264841")');

//$conexion->peticion("CREATE TABLE productos (id,nombreproducto,precio,dimensiones)");
//$conexion->peticion('INSERT INTO productos VALUES("1","raton","20","10x5x6",)');

$datos = $conexion->peticion("SELECT * FROM clientes  ORDER BY apellidos ASC");
echo '<table border="1">';
echo"<tr><td>nombre</td><td>apellidos</td><td>telefono</td><td>email</td></tr>";
for($i = 0;$i<count($datos);$i++){
    echo"<tr><td>".$datos[$i]['nombre']."</td><td>".$datos[$i]['apellidos']."</td><td>".$datos[$i]['telefono']."</td><td>".$datos[$i]['email']."</td></tr>";
}
echo"</table>";
   /*
    $datos = $conexion->peticion("DELETE * FROM clientes WHERE nombre = 'hector' ");
*/
//echo "Vamos a ver lo que queda depsues de eliminar<br>";

$datos = $conexion->peticion("SELECT * FROM clientes ORDER BY apellidos ASC");
echo '<table border="1">';
echo"<tr><td>nombre</td><td>apellidos</td><td>telefono</td><td>email</td></tr>";
for($i = 0;$i<count($datos);$i++){
    echo"<tr><td>".$datos[$i]['nombre']."</td><td>".$datos[$i]['apellidos']."</td><td>".$datos[$i]['telefono']."</td><td>".$datos[$i]['email']."</td></tr>";
}
echo"</table>"
?>