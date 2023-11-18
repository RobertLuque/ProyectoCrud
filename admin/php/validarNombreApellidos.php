<?php
include("fm_conexion.php");

$DatosRepetidos = "SELECT COUNT(*) TotalRepetidos, nombres, apellidos FROM registros WHERE nombres LIKE LOWER('".$_POST["nombre"]."')  AND apellidos LIKE LOWER ('".$_POST["apellido"]."') GROUP BY nombres HAVING TotalRepetidos";

$consulta = mysqli_query($enlace,$DatosRepetidos);
$duplicado = mysqli_num_rows($consulta);

$verificacion = false;

    if($duplicado == 0){
        $verificacion = true;
    }


$ValidarCorreo = "SELECT COUNT(*) TotalRepetidos, correo FROM registros WHERE correo LIKE LOWER('".$_POST["correo"]."') GROUP BY nombres HAVING TotalRepetidos";

$consultaCorreo = mysqli_query($enlace,$ValidarCorreo);
$duplicadoCorreo = mysqli_num_rows($consultaCorreo);

$verificacionCorreo = false;

if($duplicadoCorreo == 0){
    $verificacionCorreo = true;
}


$datos = array(
    'verificacion' =>  $verificacion ,
    'verificacionCorreo' => $verificacionCorreo
    );
    //Devolvemos el array pasado a JSON como objeto
    echo json_encode($datos);

?>