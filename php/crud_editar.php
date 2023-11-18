<?php
$id = $_POST['idPerson']; //ID UNICO DE DATO OBTENIDO ANTERIORMENTE

//Datos de la persona
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$cargo = $_POST['cargo'];
$celular = $_POST['cell'];
$correo = $_POST['correo'];
//Datos de la municipalidad
$nombreMunicipio = $_POST['nombreMunicipio'];
$direccion = $_POST['direccion'];
$distrito = $_POST['distrito'];
$provincia = $_POST['provincia'];
$region = $_POST['region'];
$telefono = $_POST['telefono'];
$correoMunicipal = $_POST['correoMunicipal'];
$paginaWeb = $_POST['paginaWeb'];
$estado = $_POST['estado'];


include("fm_conexion.php");
//Codigo sql
$sql = "UPDATE registros set nombres = '$nombre', apellidos = '$apellido', cargo = '$cargo', celular = $celular, correo = '$correo', nombreMunicipio = '$nombreMunicipio', direccion = '$direccion', distrito = '$distrito', provincia = '$provincia', region = '$region', telefono = $telefono, correoMunicipal = '$correoMunicipal', paginaWeb = '$paginaWeb', estado = '$estado' WHERE idPerson like '$id'";

echo $sql;
//mysql_query envia una sentencia a la base de datos

$queryE = mysqli_query($enlace, $sql);
if(!$queryE){
    echo "No se actualizaron los datos ";
}else{
    header("Location: ../msg_registroActualizado.php");
}

?>