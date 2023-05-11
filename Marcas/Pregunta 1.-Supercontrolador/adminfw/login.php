<?php

session_start();

//Abro la conexion con la base de datos
include "conexiondb.php";
//Le pido algo a la base
$resultado = mysqli_query($enlace, "

    SELECT * FROM usuarios
    WHERE
    usuario = '".$_POST['usuario']."'
    AND 
    password = '".$_POST['contrasena']."'
    LIMIT 1
");

$pasas = false;
$_SESSION['pasas'] = false;

//Devuelvo por pantalla lo que me de
if($fila = $resultado->fetch_assoc()){
   // echo $fila['nombre']." ".$fila['apellidos']."<br>"; 
    $pasas = true;
    $_SESSION['nombre'] = $fila['nombre'];
    $_SESSION['apellidos'] = $fila['apellidos'];
}else{
    //echo"No hay ningun usuario que cumpla esas caracteristicas";
    $pasas = false;
    
}

//Validamos
if($pasas){
    echo"Te voy a dar acceso a la aplicacion";
    $_SESSION['pasas'] = true;
    echo '<meta http-equiv="refresh" content="5; url=escritorio.php">';
}else{
    $_SESSION['pasas'] = false;
    echo"No te voy a dar acceso a la aplicacion";
    echo '<meta http-equiv="refresh" content="5; url=index.html">';
}
//Cierro los recursos que haya abierto
mysqli_close($enlace);

?>