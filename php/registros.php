<?php
//Datos de la persona

$nombre = utf8_encode($_POST['nombre']);
$apellido = utf8_encode($_POST['apellido']);
$cargo = utf8_encode($_POST['cargo']);
$celular = utf8_encode($_POST['cell']);
$correo = utf8_encode($_POST['correo']);
//Datos de la municipalidad
$nombreMunicipio = utf8_encode($_POST['nombreMunicipio']);
$direccion = utf8_encode($_POST['direccion']);
$distrito = utf8_encode($_POST['distrito']);
$provincia = utf8_encode($_POST['provincia']);
$region = utf8_encode($_POST['region']);
$telefono = utf8_encode($_POST['telefono']);
$correoMunicipal = utf8_encode($_POST['correoMunicipal']);
$paginaWeb = utf8_encode($_POST['paginaWeb']);
$estado = "archivado";

include("fm_conexion.php");
//Codigo sql
$sql = "INSERT INTO registros (idPerson, nombres, apellidos, cargo, celular, correo, nombreMunicipio, direccion, distrito, provincia, region, telefono, correoMunicipal, paginaWeb, estado, fecha) VALUES ( NULL,'$nombre', '$apellido', '$cargo', $celular, '$correo', '$nombreMunicipio', '$direccion', '$distrito', '$provincia', '$region', $telefono, '$correoMunicipal', '$paginaWeb', '$estado', NOW())";

//mysql_query envia una sentencia a la base de datos

$queryE = mysqli_query($enlace, $sql);
if(!$queryE){
    echo "Ocurrio un error al momento de insertar los datos";
}else{
    header("Location: ../registroEnviado.php");
}

//Enviar correos

$header = "From: $nombre \r\n";
$header .= "Reply-To: felmup@gmail.com";
$header .= "X-Mailer: PHP/" . phpversion();

$asunto = "Nuevo Registro de datos Personal";
$mensaje = "Datos Registrados \n Representante Legal \n nombre: $nombre \n apellido: $apellido \n cargo: $cargo \n celular: $celular \n correo: $correo \n";

$mensaje .= "Datos de Municipalidad \n Nombre de Municipio: $nombreMunicipio \n Dirección: $direccion \n Distrito: $distrito \n Provincia: $provincia \n Región: $region \n Teléfono: $telefono \n Correo: $correoMunicipal \n Página Web: $paginaWeb \n Estado: $estado \n Fecha: $fecha";

//*Funcion mail = (a Quien se le va a enviar, asunto, mensaje, header)
$mail = mail($correo, $asunto, $mensaje, $header);

if($mail){
    echo "<h4>!Mail enviado exitosamente<h4>";
}

?>