<?php
$id = $_GET['id'];

include("fm_conexion.php");

//Codigo sql
$sql = "DELETE FROM registros where idPerson like '$id'" ;
$cQuery = mysqli_query($enlace,$sql);

if(!$cQuery){
    echo "No se Elimino";
}else{
    header("Location: ../registrarPersonal.php");
}
?>