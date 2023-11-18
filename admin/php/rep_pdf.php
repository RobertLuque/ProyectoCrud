<?php
require('fpdf/fpdf.php');
include("fm_conexion.php");


class PDF extends FPDF{
    public $variable = 'registros';
    //Cabezera
function Header(){
    //Tipo de Letra
    $this->SetFont('Arial','B','15');
    //Mover a la derecha
    //$this->cell(100);
    //cabezera datos
    if($this->variable == 'registros'){
        //Titulo --Cell(Ancho,largo, texto dentro, datos del cuadro)
        $this->cell(250,10,'Reporte de Registros Femulp',0,0,'C');
        // Salto de linea
        $this->Ln(20);
        //Tipo de Letra
        $this->SetFont('Arial','B','11');
        // Datos
        $this->Cell(8,10, 'ID',1 ,0,'C');
        $this->Cell(35,10, 'Nombres',1 ,0,'C');
        $this->Cell(35,10, 'Apellido',1 ,0,'C');
        $this->Cell(25,10, 'Cargo',1 ,0,'C');
        $this->Cell(18,10, 'Celular',1 ,0,'C');
        $this->Cell(45,10, 'Correo',1 ,0,'C');
        $this->Cell(70,10, 'Nombre del Municipio',1 ,0,'C');
        $this->Cell(30,10, 'Fecha',1 ,0,'C');
        $this->Cell(15,10, 'Estado',1 ,1,'C');
    }elseif($this->variable == 'municipiosDatos1'){
        //Titulo --Cell(Ancho,largo, texto dentro, datos del cuadro)
        $this->cell(270,10,'Datos de Municipalidades en los Registros de Femulp',0,0,'C');
        // Salto de linea
        $this->Ln(20);
        //Tipo de Letra
        $this->SetFont('Arial','B','11');
        // Datos
        $this->Cell(75,10, 'Nombre del Municipio',1 ,0,'C');
        $this->Cell(85,10, 'direccion',1 ,0,'C');
        $this->Cell(40,10, 'distrito',1 ,0,'C');
        $this->Cell(40,10, 'provincia',1 ,0,'C');
        $this->Cell(40,10, 'region',1 ,1,'C');
    }elseif($this->variable == 'municipiosDatos2'){
        //Titulo --Cell(Ancho,largo, texto dentro, datos del cuadro)
        $this->cell(270,10,'Datos de Municipalidades en los Registros de Femulp',0,0,'C');
        // Salto de linea
        $this->Ln(20);
        //Tipo de Letra
        $this->SetFont('Arial','B','11');
        // Datos
        $this->Cell(75,10, 'Nombre del Municipio',1 ,0,'C');
        $this->Cell(30,10, 'telefono',1 ,0,'C');
        $this->Cell(80,10, 'correoMunicipal',1 ,0,'C');
        $this->Cell(80,10, 'paginaWeb',1 ,1,'C');
    }elseif($this->variable == 'nivelEficacia'){
        //Titulo --Cell(Ancho,largo, texto dentro, datos del cuadro)
        $this->cell(260,10,'Nivel de Eficacia en el reporte de Femulp',0,0,'C');
        // Salto de linea
        $this->Ln(20);
        $this->SetFont('Arial','B','11');
    }
}

//Pie de pagina
function Footer(){
    //Posicion: a 1,5 cm del final
    $this->SetY(-15);
    //Arial italic 8
    $this->SetFont('Arial','I',10);
    //Numero de Paginas
    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}


$buscardor = "SELECT * FROM registros WHERE (nombres LIKE LOWER('%".$_GET["buscar"]."%') AND estado LIKE LOWER('%".$_GET["estados"]."%'))  OR  (apellidos LIKE LOWER ('%".$_GET["buscar"]."%') AND estado LIKE LOWER('%".$_GET["estados"]."%')) OR (nombreMunicipio LIKE LOWER ('%".$_GET["buscar"]."%') AND estado LIKE LOWER('%".$_GET["estados"]."%'))";

$cQuery = mysqli_query($enlace,$buscardor);


$pdf=new PDF('L','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',8);


while($mostrar = mysqli_fetch_assoc($cQuery)){
    //Cell(ancho,alto, texto, borde, salto de linea, justificado, relleno)
    $pdf->Cell(8,10, utf8_decode($mostrar['idPerson']),1 ,0,'C');
    $pdf->Cell(35,10, utf8_decode($mostrar['nombres']),1 ,0,'C');
    $pdf->Cell(35,10, utf8_decode($mostrar['apellidos']),1 ,0,'C');
    $pdf->Cell(25,10, utf8_decode($mostrar['cargo']),1 ,0,'C');
    $pdf->Cell(18,10, utf8_decode($mostrar['celular']),1 ,0,'C');
    $pdf->Cell(45,10, utf8_decode($mostrar['correo']),1 ,0,'C');
    $pdf->Cell(70,10, utf8_decode($mostrar['nombreMunicipio']),1 ,0,'C');
    $pdf->Cell(30,10, utf8_decode($mostrar['fecha']),1 ,0,'C');
    $pdf->Cell(15,10, utf8_decode($mostrar['estado']),1 ,1,'C');
}



$pdf->variable = 'municipiosDatos1';
$pdf->AddPage();
$pdf->SetFont('Arial','B',9);

$sqlMunicipio = "SELECT *,COUNT(*) TotalRepetidos, nombreMunicipio FROM registros WHERE (nombres LIKE LOWER('%".$_GET["buscar"]."%') AND estado LIKE LOWER('%".$_GET["estados"]."%'))  OR  (apellidos LIKE LOWER ('%".$_GET["buscar"]."%') AND estado LIKE LOWER('%".$_GET["estados"]."%')) OR (nombreMunicipio LIKE LOWER ('%".$_GET["buscar"]."%') AND estado LIKE LOWER('%".$_GET["estados"]."%')) GROUP BY nombreMunicipio HAVING TotalRepetidos ";
$consulta = mysqli_query($enlace,$sqlMunicipio);


while($filaVer = mysqli_fetch_assoc($consulta)){
    $pdf->Cell(75,10, utf8_decode($filaVer['nombreMunicipio']),1 ,0,'C');
    $pdf->Cell(85,10, utf8_decode($filaVer['direccion']),1 ,0,'C');
    $pdf->Cell(40,10, utf8_decode($filaVer['distrito']),1 ,0,'C');
    $pdf->Cell(40,10, utf8_decode($filaVer['provincia']),1 ,0,'C');
    $pdf->Cell(40,10, utf8_decode($filaVer['region']),1 ,1,'C');
}

$pdf->variable = 'municipiosDatos2';

$pdf->Ln(20);
$pdf->SetFontSize(11);
$pdf->Cell(75,10, 'Nombre del Municipio',1 ,0,'C');
$pdf->Cell(30,10, 'telefono',1 ,0,'C');
$pdf->Cell(80,10, 'correoMunicipal',1 ,0,'C');
$pdf->Cell(80,10, 'paginaWeb',1 ,1,'C');

$pdf->SetFontSize(9);
$sqlMunicipio = "SELECT *,COUNT(*) TotalRepetidos, nombreMunicipio FROM registros  WHERE (nombres LIKE LOWER('%".$_GET["buscar"]."%') AND estado LIKE LOWER('%".$_GET["estados"]."%'))  OR  (apellidos LIKE LOWER ('%".$_GET["buscar"]."%') AND estado LIKE LOWER('%".$_GET["estados"]."%')) OR (nombreMunicipio LIKE LOWER ('%".$_GET["buscar"]."%') AND estado LIKE LOWER('%".$_GET["estados"]."%')) GROUP BY nombreMunicipio HAVING TotalRepetidos";
$consulta = mysqli_query($enlace,$sqlMunicipio);
while($filaVer = mysqli_fetch_assoc($consulta)){
    $pdf->Cell(75,10, utf8_decode($filaVer['nombreMunicipio']),1 ,0,'C');
    $pdf->Cell(30,10, utf8_decode($filaVer['telefono']),1 ,0,'C');
    $pdf->Cell(80,10, utf8_decode($filaVer['correoMunicipal']),1 ,0,'C');
    $pdf->Cell(80,10, utf8_decode($filaVer['paginaWeb']),1 ,1,'C');
}



//VARIABLES PARA EL CUADRO DE EFICACIA
$aceptado = $_GET["aceptados"];
$archivados = $_GET["archivados"];
$rechazados = $_GET["rechazados"];
$total = $_GET["total"];
$eficaciaAceptados = $_GET["eficaciaAceptados"];
$eficaciaArchivados = $_GET["eficaciaArchivados"];
$eficaciaRechazados = $_GET["eficaciaRechazados"];


$pdf->variable = 'nivelEficacia';
$pdf->AddPage();
$pdf->SetFontSize(11);

$pdf->cell(50);
$pdf->Cell(160,10, 'Nivel de Eficacia',1 ,1,'C');

$pdf->cell(50);
$pdf->Cell(80,10, 'Eficacia Aceptados',1 ,0,'C');
$pdf->Cell(80,10, "$eficaciaAceptados%",1 ,1,'C');

$pdf->cell(50);
$pdf->Cell(80,10, 'Eficacia Archivados',1 ,0,'C');
$pdf->Cell(80,10, "$eficaciaArchivados%",1 ,1,'C');

$pdf->cell(50);
$pdf->Cell(80,10, 'Eficacia Rechazados',1 ,0,'C');
$pdf->Cell(80,10, "$eficaciaRechazados%",1 ,1,'C');



$pdf->Ln(20);
$pdf->cell(50);
$pdf->Cell(160,10, 'Datos Totales',1 ,1,'C');

$pdf->cell(50);
$pdf->Cell(80,10, 'Cantidad Aceptados',1 ,0,'C');
$pdf->Cell(80,10, $aceptado,1 ,1,'C');

$pdf->cell(50);
$pdf->Cell(80,10, 'Cantidad Archivados',1 ,0,'C');
$pdf->Cell(80,10, $archivados,1 ,1,'C');

$pdf->cell(50);
$pdf->Cell(80,10, 'Cantidad Rechazados',1 ,0,'C');
$pdf->Cell(80,10, $rechazados,1 ,1,'C');

$pdf->cell(50);
$pdf->Cell(80,10, 'Cantidad Total',1 ,0,'C');
$pdf->Cell(80,10, $total,1 ,1,'C');





$modo="I";
$nombre_archivo="Reporte General Femulp.pdf";
$pdf->Output($nombre_archivo,$modo);

?>