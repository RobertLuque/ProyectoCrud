<?php
//Seteamos el header de "content-type" como "JSON" para que jQuery lo reconozca como tal
header('Content-Type: application/json');
//Guardamos los datos en un array
include("fm_conexion.php");
$buscardor = "SELECT * FROM registros WHERE (nombres LIKE LOWER('%".$_POST["buscar"]."%') AND estado LIKE LOWER('%".$_POST["estados"]."%'))  OR  (apellidos LIKE LOWER ('%".$_POST["buscar"]."%') AND estado LIKE LOWER('%".$_POST["estados"]."%')) OR (nombreMunicipio LIKE LOWER ('%".$_POST["buscar"]."%') AND estado LIKE LOWER('%".$_POST["estados"]."%'))";

$cQuery = mysqli_query($enlace,$buscardor);

$cantAceptado = 0;
$cantArchivado = 0;
$cantRechazado = 0;


if ($_POST["estados"] == '') {
    $sqlAceptado = "SELECT COUNT(*) totalAceptados FROM registros WHERE (nombres LIKE LOWER('%".$_POST["buscar"]."%') AND estado LIKE LOWER('aceptado'))  OR  (apellidos LIKE LOWER ('%".$_POST["buscar"]."%') AND estado LIKE LOWER('aceptado')) OR (nombreMunicipio LIKE LOWER ('%".$_POST["buscar"]."%') AND estado LIKE LOWER('aceptado'))";
    $aceptado = mysqli_query($enlace,$sqlAceptado);
    $filasAceptado = mysqli_fetch_assoc($aceptado);
    $cantAceptado = $filasAceptado['totalAceptados'];


    $sqlArchivado = "SELECT COUNT(*) totalArchivados FROM registros WHERE (nombres LIKE LOWER('%".$_POST["buscar"]."%') AND estado LIKE LOWER('archivado'))  OR  (apellidos LIKE LOWER ('%".$_POST["buscar"]."%') AND estado LIKE LOWER('archivado')) OR (nombreMunicipio LIKE LOWER ('%".$_POST["buscar"]."%') AND estado LIKE LOWER('archivado'))";
    $archivado = mysqli_query($enlace,$sqlArchivado);
    $filasArchivado = mysqli_fetch_assoc($archivado);
    $cantArchivado = $filasArchivado['totalArchivados'];

    $sqlRechazado = "SELECT COUNT(*) totalRechazados FROM registros WHERE (nombres LIKE LOWER('%".$_POST["buscar"]."%') AND estado LIKE LOWER('rechazado'))  OR  (apellidos LIKE LOWER ('%".$_POST["buscar"]."%') AND estado LIKE LOWER('rechazado')) OR (nombreMunicipio LIKE LOWER ('%".$_POST["buscar"]."%') AND estado LIKE LOWER('rechazado'))";
    $rechazado = mysqli_query($enlace,$sqlRechazado);
    $filasRechazado = mysqli_fetch_assoc($rechazado);
    $cantRechazado = $filasRechazado['totalRechazados'];
}


if ($_POST["estados"] == 'aceptado') {

    $sqlAceptado = "SELECT COUNT(*) totalAceptados FROM registros WHERE (nombres LIKE LOWER('%".$_POST["buscar"]."%') AND estado LIKE LOWER('%".$_POST["estados"]."%'))  OR  (apellidos LIKE LOWER ('%".$_POST["buscar"]."%') AND estado LIKE LOWER('%".$_POST["estados"]."%')) OR (nombreMunicipio LIKE LOWER ('%".$_POST["buscar"]."%') AND estado LIKE LOWER('%".$_POST["estados"]."%'))";
    $aceptado = mysqli_query($enlace,$sqlAceptado);
    $filasAceptado = mysqli_fetch_assoc($aceptado);
    $cantAceptado = $filasAceptado['totalAceptados'];

}

if ($_POST["estados"] == 'archivado') {

$sqlArchivado = "SELECT COUNT(*) totalArchivados FROM registros WHERE (nombres LIKE LOWER('%".$_POST["buscar"]."%') AND estado LIKE LOWER('%".$_POST["estados"]."%'))  OR  (apellidos LIKE LOWER ('%".$_POST["buscar"]."%') AND estado LIKE LOWER('%".$_POST["estados"]."%')) OR (nombreMunicipio LIKE LOWER ('%".$_POST["buscar"]."%') AND estado LIKE LOWER('%".$_POST["estados"]."%'))";
$archivado = mysqli_query($enlace,$sqlArchivado);
$filasArchivado = mysqli_fetch_assoc($archivado);
$cantArchivado = $filasArchivado['totalArchivados'];

}

if ($_POST["estados"] == 'rechazado') {

$sqlRechazado = "SELECT COUNT(*) totalRechazados FROM registros WHERE (nombres LIKE LOWER('%".$_POST["buscar"]."%') AND estado LIKE LOWER('%".$_POST["estados"]."%'))  OR  (apellidos LIKE LOWER ('%".$_POST["buscar"]."%') AND estado LIKE LOWER('%".$_POST["estados"]."%')) OR (nombreMunicipio LIKE LOWER ('%".$_POST["buscar"]."%') AND estado LIKE LOWER('%".$_POST["estados"]."%'))";
$rechazado = mysqli_query($enlace,$sqlRechazado);
$filasRechazado = mysqli_fetch_assoc($rechazado);
$cantRechazado = $filasRechazado['totalRechazados'];

}

$total = $cantAceptado  + $cantArchivado + $cantRechazado;
$eficaciaAceptados =  round( ($cantAceptado / $total) * 100, 2);
$eficaciaArchivados =  round(($cantArchivado / $total) * 100, 2);
$eficaciaRechazados =  round(($cantRechazado / $total) * 100, 2);



$datos = array(
'aceptados' => $cantAceptado ,
'archivados' => $cantArchivado,
'rechazados' => $cantRechazado,
'eficaciaAceptados' => $eficaciaAceptados,
'eficaciaArchivados' => $eficaciaArchivados,
'eficaciaRechazados' => $eficaciaRechazados,
'total' => $total,
'buscar' => $_POST["buscar"],
'estados' => $_POST["estados"],
);
//Devolvemos el array pasado a JSON como objeto
echo json_encode($datos);
?>