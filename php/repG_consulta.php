<?php
include("fm_conexion.php");
//select count(IdUser) from tabla where date_format(fecha,'%mm')=$i and date_format(fecha,'%Y')=date_format(Now(),'%Y');
for($i = 1, $a = 0; $i <= 12; $i++, $a++){
//$consultaSQL[$a] = "SELECT count(idPerson) FROM registros WHERE date_format(fecha,'%mm')=$i and date_format(fecha,'%Y')=date_format(Now(),'%Y')";
if($i < 10){
    $mes = "0$i";
}else{
    $mes = $i;
}

$anioBusqueda = $_GET['anioBusqueda'];
$consultaSQL[$a] = "SELECT count(idPerson) cantMeses FROM registros WHERE MONTH(fecha) = $mes AND YEAR(fecha) = $anioBusqueda";
$cQuery[$a] = mysqli_query($enlace,$consultaSQL[$a]);
$meses[$a] = mysqli_fetch_assoc($cQuery[$a]);
//echo $mEnero = $meses[$a]['cantMeses'] . "<br>";
}


?>

<script>
var mEnero = <?php echo $meses[0]['cantMeses'];?>;
var mFebrero = <?php echo $meses[1]['cantMeses'];?>;
var mMarzo = <?php echo $meses[2]['cantMeses'];?>;
var mAbril = <?php echo $meses[3]['cantMeses'];?>;
var mMayo = <?php echo $meses[4]['cantMeses'];?>;
var mJunio = <?php echo $meses[5]['cantMeses'];?>;
var mJulio = <?php echo $meses[6]['cantMeses'];?>;
var mAgosto = <?php echo $meses[7]['cantMeses'];?>;
var mSeptiembre = <?php echo $meses[8]['cantMeses'];?>;
var mOctubre = <?php echo $meses[9]['cantMeses'];?>;
var mNoviembre = <?php echo $meses[10]['cantMeses'];?>;
var mDiciembre = <?php echo $meses[11]['cantMeses'];?>;
</script>