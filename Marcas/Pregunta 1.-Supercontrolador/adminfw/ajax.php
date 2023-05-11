<?php

//Este archivo actualiza un solo dato
include "conexiondb.php";
        $peticion = "
        UPDATE ".$_GET['tabla']."
        SET ".$_GET['columna']." = '".$_GET['valor']."'
        WHERE 
        Identificador = ".$_GET['identificador']."
        ";
        mysqli_query($enlace,$peticion);
    

?>