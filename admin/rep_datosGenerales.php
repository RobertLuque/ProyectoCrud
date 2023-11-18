<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/rep_datosG.css">
</head>

<body>
    <div class="title">
        <h1>Datos Generales del Año <?php echo $_GET['anioBusqueda']?></h1>
    </div>
    <?php include("php/fm_conexion.php"); ?>
    <?php
                    $anioBusqueda = $_GET['anioBusqueda'];
                    $sqlAceptado = "SELECT COUNT(*) totalAceptados FROM registros WHERE estado LIKE 'aceptado' AND YEAR(fecha) = $anioBusqueda";
                    $aceptado = mysqli_query($enlace,$sqlAceptado);
                    $filasAceptado = mysqli_fetch_assoc($aceptado);

                    $sqlArchivado = "SELECT COUNT(*) totalArchivados FROM registros WHERE estado LIKE 'archivado'  AND YEAR(fecha) = $anioBusqueda";
                    $archivado = mysqli_query($enlace,$sqlArchivado);
                    $filasArchivado = mysqli_fetch_assoc($archivado);

                    $sqlRechazado = "SELECT COUNT(*) totalRechazados FROM registros WHERE estado LIKE 'rechazado'  AND YEAR(fecha) = $anioBusqueda";
                    $rechazado = mysqli_query($enlace,$sqlRechazado);
                    $filasRechazado = mysqli_fetch_assoc($rechazado);

                    $total = $filasAceptado['totalAceptados'] + $filasArchivado['totalArchivados'] + $filasRechazado['totalRechazados'];
                    $eficacia =  ($filasAceptado['totalAceptados'] / $total) * 100;
                    ?>
    <script>
    var aceptado = <?php echo $filasAceptado['totalAceptados']?>;
    var archivado = <?php echo $filasArchivado['totalArchivados']?>;
    var rechazado = <?php echo $filasRechazado['totalRechazados']?>;
    </script>

    <div class="graficosInformacion">
        <div class="graficoMeses">
            <canvas id="graficoMeses"></canvas>

        </div>
        <div class="grafico">
            <canvas id="graficoEficacia" style="color:white"></canvas>
            <table class="datosInfo">
                <tr>
                    <td>Total De Personas:</td>
                    <td><?php echo $total?></td>
                </tr>
                <tr>
                    <td>Nivel de Eficacia:</td>
                    <td><?php echo round($eficacia, 2)  . "%"?></td>
                </tr>
                <tr>
                    <?php include("php/repG_consulta.php");?>
                </tr>
            </table>
        </div>
    </div>


    <div class="aniosGrafico">

        <?php
    $aniosBuscar = "SELECT COUNT(*) TotalRepetidos, date_format(fecha, '%Y') FROM registros GROUP BY date_format(fecha, '%Y') HAVING TotalRepetidos";

    $consulta = mysqli_query($enlace,$aniosBuscar);
    $count = 0;
    while($filaVer = mysqli_fetch_assoc($consulta)){
        ?>

        <a href="rep_datosGenerales.php?anioBusqueda=<?php echo $filaVer["date_format(fecha, '%Y')"]; ?>" class="anios">
            <p><?php echo $filaVer["date_format(fecha, '%Y')"]; ?></p>
        </a>

        <?php $count++; }?>
    </div>

    <!--COMIENZO DEL GRAFICO DE BARRAS-->
    <script>
    const gMeses = document.getElementById('graficoMeses');
    Chart.defaults.color = '#FFFFFF';
    new Chart(gMeses, {
        type: 'bar',
        data: {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre',
                'Octubre', 'Noviembre ', 'Diciembre'
            ],
            datasets: [{
                label: 'Personas',
                data: [mEnero, mFebrero, mMarzo, mAbril, mMayo, mJunio, mJulio, mAgosto,
                    mSeptiembre,
                    mOctubre,
                    mNoviembre, mDiciembre
                ],
                borderWidth: 1,
                backgroundColor: [
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(255, 205, 86, 0.5)',
                    'rgba(255, 159, 64, 0.5)',
                    'rgba(255, 100, 234, 0.5)',
                    'rgba(103, 216, 255, 0.5)',
                    'rgba(139, 94, 94, 0.5)',
                    'rgba(208, 126, 0, 0.5)',
                    'rgba(201, 203, 207, 0.5)',
                    'rgba(209, 95, 255, 0.5)'
                ],
                borderColor: [
                    'rgb(75, 192, 192)',
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(255, 205, 86)',
                    'rgb(255, 159, 64)',
                    'rgba(255, 100, 234)',
                    'rgba(103, 216, 255)',
                    'rgba(139, 94, 94)',
                    'rgba(208, 126, 0)',
                    'rgb(201, 203, 207)',
                    'rgb(209, 95, 255)'
                ],

            }],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                }
            }
        }
    });
    </script>
    <!--FIN DEL GRAFICO-->



    <!--COMIENZO DEL GRAFICO DE EFICACIA-->
    <script>
    var ctx = document.getElementById('graficoEficacia');
    Chart.defaults.color = '#FFFFFF';
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Aceptado', 'Archivado', 'Rechazado'],
            datasets: [{
                label: 'Personas',
                data: [aceptado, archivado, rechazado],
                backgroundColor: [
                    '#69FF43',
                    '#FDEC54',
                    '#FF665C'
                ],
                borderWidth: 1
            }]
        }
    });
    </script>
    <!--FIN DEL GRAFICO-->
    <a class="regresar" href="reportes.php">
        <div>
            <p>Volver</p>
        </div>
    </a>
    <!-- INICIO SCRIPT PARA MARCAR EL AÑO-->
    <script>
    for (var i = 0; i < <?php echo $count;?>; i++) {
        if (document.getElementsByClassName("anios")[i].innerText == "<?php echo $_GET['anioBusqueda']?>") {
            document.getElementsByClassName("anios")[i].className += " activeAnio";
        }

    }
    </script>
    <!-- FIN SCRIPT PARA MARCAR EL AÑO-->
</body>

</html>