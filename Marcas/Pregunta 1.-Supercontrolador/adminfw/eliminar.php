<?php
//Aqui borramos el campo establecido

include "conexiondb.php";
$resultado = mysqli_query($enlace, "

    DELETE FROM ".$_GET['tabla']." WHERE Identificador = ".$_GET['id']."
");

    echo '<meta http-equiv="refresh" content="2; url=escritorio.php?tabla=cursos">';
?>

