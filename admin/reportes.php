<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/reportes.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>



</head>

<body>
    <div class="boxPadre">

        <?php include("php/fm_conexion.php"); ?>

        <div class="registroLargo estados">
            <p>Busqueda:</p>
            <!--Funcion onkeyup -->
            <input onkeyup="filtroBusqueda($('#buscadorFiltro').val(),$('input:radio[name=estado]:checked').val());"
                type="text" id="buscadorFiltro" name="buscar">
            <p>Estado:</p>
            <label class="content-input todo" for="todo">
                <input type="radio" name="estado" id="todo" value=""
                    onclick="filtroBusqueda($('#buscadorFiltro').val(),$('input:radio[name=estado]:checked').val());"
                    checked>Todos
                <i></i>
            </label>
            <label class="content-input aceptado" for="aceptado">
                <input type="radio" name="estado" id="aceptado" value="aceptado"
                    onclick="filtroBusqueda($('#buscadorFiltro').val(),$('input:radio[name=estado]:checked').val());">Aceptado
                <i></i>
            </label>
            <label class="content-input archivado" for="archivado">
                <input type="radio" name="estado" id="archivado" value="archivado"
                    onclick="filtroBusqueda($('#buscadorFiltro').val(),$('input:radio[name=estado]:checked').val());">Archivado
                <i></i>
            </label>
            <label class="content-input rechazado" for="rechazado">
                <input type="radio" name="estado" id="rechazado" value="rechazado"
                    onclick="filtroBusqueda($('#buscadorFiltro').val(),$('input:radio[name=estado]:checked').val());">Rechazado
                <i></i>
            </label>
        </div>

        <div class="boxIzquierda boxInformacion">


            <div class="resultsBusqueda">
                <table class="tableDatos" cellspacing="0" id="filtroFm">
                    <tr class="principal">
                        <th>ID</th>
                        <th>Nombres</th>
                        <th>Apellido</th>
                        <th>Cargo</th>
                        <th>Celular</th>
                        <th>Correo</th>
                        <th>Nombre_Municipio</th>
                        <th>Direccion</th>
                        <th>Distrito</th>
                        <th>Provincia</th>
                        <th>Region</th>
                        <th>Telefono</th>
                        <th>Correo Municipal</th>
                        <th>Pagina Web</th>
                        <th>Fecha_de_Registro_</th>
                    </tr>
                    <?php

                    $sql = "SELECT * FROM registros ";
                    $cQuery = mysqli_query($enlace,$sql);
                    while($mostrar = mysqli_fetch_row($cQuery)){?>

                    <tr class="<?php echo $mostrar['14']?>">
                        <td><?php echo $mostrar['0']?></td>
                        <td><?php echo $mostrar['1']?></td>
                        <td><?php echo $mostrar['2']?></td>
                        <td><?php echo $mostrar['3']?></td>
                        <td><?php echo $mostrar['4']?></td>
                        <td><?php echo $mostrar['5']?></td>
                        <td><?php echo $mostrar['6']?></td>
                        <td><?php echo $mostrar['7']?></td>
                        <td><?php echo $mostrar['8']?></td>
                        <td><?php echo $mostrar['9']?></td>
                        <td><?php echo $mostrar['10']?></td>
                        <td><?php echo $mostrar['11']?></td>
                        <td><?php echo $mostrar['12']?></td>
                        <td><?php echo $mostrar['13']?></td>
                        <td><?php echo $mostrar['15']?></td>
                    </tr>
                    <?php }?>

                    <!--CODIGO PARA VER DATOS GENERALES-->
                    <?php include("php/fm_conexion.php"); ?>
                    <?php
                    $sqlAceptado = "SELECT COUNT(*) totalAceptados FROM registros WHERE estado LIKE 'aceptado'";
                    $aceptado = mysqli_query($enlace,$sqlAceptado);
                    $filasAceptado = mysqli_fetch_assoc($aceptado);

                    $sqlArchivado = "SELECT COUNT(*) totalArchivados FROM registros WHERE estado LIKE 'archivado'";
                    $archivado = mysqli_query($enlace,$sqlArchivado);
                    $filasArchivado = mysqli_fetch_assoc($archivado);

                    $sqlRechazado = "SELECT COUNT(*) totalRechazados FROM registros WHERE estado LIKE 'rechazado'";
                    $rechazado = mysqli_query($enlace,$sqlRechazado);
                    $filasRechazado = mysqli_fetch_assoc($rechazado);

                    $total = $filasAceptado['totalAceptados'] + $filasArchivado['totalArchivados'] + $filasRechazado['totalRechazados'];
                    $eficaciaAceptados =  round(($filasAceptado['totalAceptados'] / $total) * 100, 2);
                    $eficaciaArchivados =  round(($filasArchivado['totalArchivados'] / $total) * 100, 2);
                    $eficaciaRechazados =  round(($filasRechazado['totalRechazados'] / $total) * 100, 2);
                    ?>
                    <script>
                    var aceptado = <?php echo $eficaciaAceptados?>;
                    var archivado = <?php echo $eficaciaArchivados?>;
                    var rechazado = <?php echo $eficaciaRechazados?>;

                    document.documentElement.style.setProperty('--aceptado', aceptado + "%");
                    document.documentElement.style.setProperty('--archivado', archivado + "%");
                    document.documentElement.style.setProperty('--rechazado', rechazado + "%");
                    </script>
                    <!--FIN CODIGO PARA VER DATOS GENERALES-->

                </table>
            </div>


            <div class="grafico">
                <div class="boxPorcentajes">
                    <div class="container">
                        <div class="barra" id="eficaciaAceptados">
                            <p><span>Aceptados</span><?php echo  $eficaciaAceptados?>%</p>
                            <div class="aceptado" id="AcePorcentaje" style="--wth:<?php echo  $eficaciaAceptados?>%">
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="barra" id="eficaciaArchivados">
                            <p><span>Archivados</span><?php echo  $eficaciaArchivados?>%</p>
                            <div class="archivado" id="arPorcentaje" style="--wth:<?php echo  $eficaciaArchivados?>%">
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="barra" id="eficaciaRechazados">
                            <p><span>Rechazados</span><?php echo  $eficaciaRechazados?>%</p>
                            <div class="rechazado" id="rPorcentaje" style="--wth:<?php echo  $eficaciaRechazados?>%">
                            </div>
                        </div>
                    </div>
                </div>
                <table class="datosInfo">
                    <tr>
                        <td>Personas Aceptadas:</td>
                        <td id="aceptados"><?php echo $filasAceptado['totalAceptados']?></td>
                    </tr>
                    <tr>
                        <td>Personas Archivadas:</td>
                        <td id="archivados"><?php echo $filasArchivado['totalArchivados']?></td>
                    </tr>
                    <tr>
                        <td>Personas Rechazadas:</td>
                        <td id="rechazados"><?php echo $filasRechazado['totalRechazados']?></td>
                    </tr>
                </table>
                <hr class="linea">

                <table class=" datosInfoTotal">
                    <tr>
                        <td>Total de Personas:</td>
                        <td id="total"><?php echo $total?></td>
                    </tr>
                </table>
                <div class="boxButtons">
                    <?php $AnioActual= date("Y");?>
                    <a class="datosGenerales" href="rep_datosGenerales.php?anioBusqueda=<?php echo $AnioActual;?>">
                        <div>
                            <p>Datos Generales</p>
                        </div>
                    </a>
                    <a class="datosGenerales" href="generarDatos.php">
                        <div>
                            <p>Genarar Datos</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="generarReportes">

            <a class="excel" id="excel"
                href="php/rep_excel.php?buscar=<?php echo ""?>&estados=<?php echo ""?>&aceptados=<?php echo $filasAceptado['totalAceptados']?>&archivados=<?php echo $filasArchivado['totalArchivados']?>&rechazados=<?php echo $filasRechazado['totalRechazados']?>&total=<?php echo $total?>&eficaciaAceptados=<?php echo $eficaciaAceptados;?>&eficaciaArchivados=<?php echo $eficaciaArchivados;?>&eficaciaRechazados=<?php echo $eficaciaRechazados;?>">
                <p>Generar Reportes en excel</p>
            </a>
            <a class="pdf" id="pdf"
                href="php/rep_pdf.php?buscar=<?php echo ""?>&estados=<?php echo ""?>&aceptados=<?php echo $filasAceptado['totalAceptados']?>&archivados=<?php echo $filasArchivado['totalArchivados']?>&rechazados=<?php echo $filasRechazado['totalRechazados']?>&total=<?php echo $total?>&eficaciaAceptados=<?php echo $eficaciaAceptados;?>&eficaciaArchivados=<?php echo $eficaciaArchivados;?>&eficaciaRechazados=<?php echo $eficaciaRechazados;?>"
                target="_blank">
                <!--
+ '&aceptados=' + obj.aceptados + '&archivados=' + obj.archivados + '&rechazados=' + obj.rechazados + '&total=' + obj.total + '&eficaciaAceptados=' + obj.eficaciaAceptados + '&eficaciaArchivados=' + obj.eficaciaArchivados + '&eficaciaRechazados=' + obj.eficaciaRechazados
                -->
                <p>Generar Reportes en PDF</p>
            </a>
        </div>

        <a class="regresar" href="opFemult.php">
            <div>
                <p>Volver</p>
            </div>
        </a>
        <div id="resultado">

        </div>
        <script type="text/javascript">
        function filtroBusqueda(buscar, estado) {
            var parametros = {
                "buscar": buscar,
                "estados": estado
            };
            $.ajax({
                data: parametros,
                type: 'POST',
                url: 'php/rep_busDatoE.php',
                success: function(data) {
                    document.getElementById("filtroFm").innerHTML = data;

                }
            });
            $.ajax({
                data: parametros,
                dataType: 'json',
                type: 'POST',
                url: 'php/rep_DevolverDatosJson.php',
                success: function(data) {
                    var json_string = JSON.stringify(data);

                    //convertir el texto a un nuevo objeto
                    var obj = $.parseJSON(json_string);

                    /*asignar los valores obtenidos del objeto
                     * a cada unos de losc controlres deseados
                     * en el formulario*/
                    $('#aceptados').html(obj.aceptados);
                    $('#archivados').html(obj.archivados);
                    $('#rechazados').html(obj.rechazados);
                    $('#eficaciaAceptados').html("<p><span> Aceptados </span>" + obj.eficaciaAceptados +
                        "%</p>" + "<div class='aceptado' style = '--wth:" + obj.eficaciaAceptados +
                        "%' > ");
                    $('#eficaciaArchivados').html("<p><span> Archivados </span>" + obj.eficaciaArchivados +
                        "%</p>" + "<div class='archivado' style = '--wth:" + obj.eficaciaArchivados +
                        "%' > ");
                    $('#eficaciaRechazados').html("<p><span> Rechazados </span>" + obj.eficaciaRechazados +
                        "%</p>" + "<div class='rechazado' style = '--wth:" + obj.eficaciaRechazados +
                        "%' >  ");
                    $('#total').html(obj.total);

                    document.documentElement.style.setProperty('--aceptado', obj.eficaciaAceptados + "%");
                    document.documentElement.style.setProperty('--archivado', obj.eficaciaArchivados + "%");
                    document.documentElement.style.setProperty('--rechazado', obj.eficaciaRechazados + "%");
                    document.getElementById('excel').href = 'php/rep_excel.php?buscar=' +
                        obj.buscar + '&estados=' + obj.estados + '&aceptados=' + obj.aceptados +
                        '&archivados=' + obj.archivados + '&rechazados=' + obj.rechazados + '&total=' +
                        obj.total + '&eficaciaAceptados=' + obj.eficaciaAceptados + '&eficaciaArchivados=' +
                        obj.eficaciaArchivados + '&eficaciaRechazados=' + obj.eficaciaRechazados;
                    document.getElementById('pdf').href = 'php/rep_pdf.php?buscar=' +
                        obj.buscar + '&estados=' + obj.estados + '&aceptados=' + obj.aceptados +
                        '&archivados=' + obj.archivados + '&rechazados=' + obj.rechazados + '&total=' +
                        obj.total + '&eficaciaAceptados=' + obj.eficaciaAceptados + '&eficaciaArchivados=' +
                        obj.eficaciaArchivados + '&eficaciaRechazados=' + obj.eficaciaRechazados;
                }
            });
        }
        </script>
</body>

</html>