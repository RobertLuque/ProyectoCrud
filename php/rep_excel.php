<?php
header("Pragma: public");
header("Expires: 0");
$date = date("d-m-Y");
$filename = "Reporte Femulp $date.xls";
header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

include("fm_conexion.php");
$buscardor = "SELECT * FROM registros WHERE (nombres LIKE LOWER('%".$_GET["buscar"]."%') AND estado LIKE LOWER('%".$_GET["estados"]."%'))  OR  (apellidos LIKE LOWER ('%".$_GET["buscar"]."%') AND estado LIKE LOWER('%".$_GET["estados"]."%')) OR (nombreMunicipio LIKE LOWER ('%".$_GET["buscar"]."%') AND estado LIKE LOWER('%".$_GET["estados"]."%'))";

$cQuery = mysqli_query($enlace,$buscardor);
?>
<style type="text/css">
th,
td {
    font-size: 11;

}
</style>
<table border="0">
    <tbody>
        <tr>
            <td>
                <table border="1">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <th>Nombres</th>
                            <th>Apellido</th>
                            <th>Cargo</th>
                            <th>Celular</th>
                            <th>Correo</th>
                            <th>Nombre_Municipio</th>
                            <th>Fecha_de_Registro_</th>
                            <th>Estado</th>
                        </tr>

                        <?php $cont = 1;
                        while($mostrar = mysqli_fetch_assoc($cQuery)){
                            $cont++;?>

                        <tr>
                            <td><?php echo utf8_encode($mostrar['idPerson'])?></td>
                            <td><?php echo utf8_decode($mostrar['nombres'])?></td>
                            <td><?php echo utf8_decode($mostrar['apellidos'])?></td>
                            <td><?php echo utf8_decode($mostrar['cargo'])?></td>
                            <td><?php echo utf8_decode($mostrar['celular'])?></td>
                            <td><?php echo utf8_decode($mostrar['correo'])?></td>
                            <td><?php echo utf8_decode($mostrar['nombreMunicipio'])?></td>
                            <td><?php echo utf8_decode($mostrar['fecha'])?></td>
                            <td><?php echo utf8_decode($mostrar['estado'])?></td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </td>

            <td>

            </td>
            <?php
$sqlMunicipio = "SELECT *,COUNT(*) TotalRepetidos, nombreMunicipio FROM registros WHERE (nombres LIKE LOWER('%".$_GET["buscar"]."%') AND estado LIKE LOWER('%".$_GET["estados"]."%'))  OR  (apellidos LIKE LOWER ('%".$_GET["buscar"]."%') AND estado LIKE LOWER('%".$_GET["estados"]."%')) OR (nombreMunicipio LIKE LOWER ('%".$_GET["buscar"]."%') AND estado LIKE LOWER('%".$_GET["estados"]."%')) GROUP BY nombreMunicipio HAVING TotalRepetidos ";
$consulta = mysqli_query($enlace,$sqlMunicipio); ?>
            <td>
                <div class="alto">
                    <table border="1">
                        <tbody>
                            <tr>
                                <th>Nombre_Municipio</th>
                                <th>Direccion</th>
                                <th>Distrito</th>
                                <th>Provincia</th>
                                <th>Region</th>
                            </tr>

                            <?php while($filaVer = mysqli_fetch_assoc($consulta)){?>

                            <tr>
                                <td><?php echo utf8_decode($filaVer['nombreMunicipio'])?></td>
                                <td><?php echo utf8_decode($filaVer['direccion'])?></td>
                                <td><?php echo utf8_decode($filaVer['distrito'])?></td>
                                <td><?php echo utf8_decode($filaVer['provincia'])?></td>
                                <td><?php echo utf8_decode($filaVer['region'])?></td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>

                    <br>
                    <?php
$sqlMunicipio = "SELECT *,COUNT(*) TotalRepetidos, nombreMunicipio FROM registros WHERE (nombres LIKE LOWER('%".$_GET["buscar"]."%') AND estado LIKE LOWER('%".$_GET["estados"]."%'))  OR  (apellidos LIKE LOWER ('%".$_GET["buscar"]."%') AND estado LIKE LOWER('%".$_GET["estados"]."%')) OR (nombreMunicipio LIKE LOWER ('%".$_GET["buscar"]."%') AND estado LIKE LOWER('%".$_GET["estados"]."%')) GROUP BY nombreMunicipio HAVING TotalRepetidos ";
$consulta = mysqli_query($enlace,$sqlMunicipio); ?>
                    <table border="1">
                        <tbody>
                            <tr>
                                <th>Nombre_Municipio</th>
                                <th>Telefono</th>
                                <th>Correo Municipal</th>
                                <th>Pagina Web</th>
                            </tr>

                            <?php $i = 0;
                        while($filaVer = mysqli_fetch_assoc($consulta)){
                            ?>

                            <tr>
                                <td><?php echo utf8_decode($filaVer['nombreMunicipio'])?></td>
                                <td><?php echo utf8_decode($filaVer['telefono'])?></td>
                                <td><?php echo utf8_decode($filaVer['correoMunicipal'])?></td>
                                <td><?php echo utf8_decode($filaVer['paginaWeb'])?></td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>

                    <br>
                    <?php
$aceptado = $_GET["aceptados"];
$archivados = $_GET["archivados"];
$rechazados = $_GET["rechazados"];
$total = $_GET["total"];
$eficaciaAceptados = $_GET["eficaciaAceptados"];
$eficaciaArchivados = $_GET["eficaciaArchivados"];
$eficaciaRechazados = $_GET["eficaciaRechazados"];
?>
                    <table border="0">
                        <tbody>
                            <tr>
                                <td colspan="2">
                                    <table border="1">
                                        <tbody>
                                            <tr>
                                                <th colspan="2">Nivel de Eficacia</th>
                                            </tr>
                                            <tr>
                                                <th>Eficacia Aceptados</th>
                                                <td><?php echo $eficaciaAceptados ?>%</td>
                                            </tr>
                                            <tr>
                                                <th>Eficacia Archivados</th>
                                                <td><?php echo $eficaciaArchivados ?>%</td>
                                            </tr>
                                            <tr>
                                                <th>Eficacia Rechazados</th>
                                                <td><?php echo $eficaciaRechazados ?>%</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td colspan="2">
                                    <table border="1">
                                        <tbody>
                                            <tr>
                                                <th colspan="2">Nivel de Eficacia</th>
                                            </tr>
                                            <tr>
                                                <th>Cantidad Aceptados</th>
                                                <td><?php echo $aceptado ?></td>
                                            </tr>
                                            <tr>
                                                <th>Cantidad Archivados</th>
                                                <td><?php echo $archivados ?></td>
                                            </tr>
                                            <tr>
                                                <th>Cantidad Rechazados</th>
                                                <td><?php echo $rechazados ?></td>
                                            </tr>
                                            <tr>
                                                <th>Cantidad Total</th>
                                                <td><?php echo $total ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </td>
        </tr>
    </tbody>
</table>