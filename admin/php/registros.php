<?php
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
$estado = "archivado";


//$enlace = mysqli_connect("127.0.0.1", "mi_usuario", "mi_contraseña", "mi_bd");
$enlace = mysqli_connect("localhost", "root", "1234", "femulp");
//Codigo sql
$sql = "INSERT INTO registros (idPerson, nombres, apellidos, cargo, celular, correo, nombreMunicipio, direccion, distrito, provincia, region, telefono, correoMunicipal, paginaWeb, estado) VALUES ( NULL,'$nombre', '$apellido', '$cargo', $celular, '$correo', '$nombreMunicipio', '$direccion', '$distrito', '$provincia', '$region', $telefono, '$correoMunicipal', '$paginaWeb', '$estado')";

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

$mensaje .= "Datos de Municipalidad \n Nombre de Municipio: $nombreMunicipio \n Dirección: $direccion \n Distrito: $distrito \n Provincia: $provincia \n Región: $region \n Teléfono: $telefono \n Correo: $correoMunicipal \n Página Web: $paginaWeb";

//*Funcion mail = (a Quien se le va a enviar, asunto, mensaje, header)
$mail = mail($correo, $asunto, $mensaje, $header);

if($mail){
    echo "<h4>!Mail enviado exitosamente<h4>";
}

?>