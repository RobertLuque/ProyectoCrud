<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="../css/general.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/mensajeAlerta.css">
    <script src="../js/regresar.js"></script>
</head>

<body>
    <div class="boxDerecha boxRegistros">
        <form action="crud_editar.php" method="post" autocomplete="off" id="formulario">
            <?php
                include("crud_busDatoE.php");
            ?>
            <Input class="invisible" type="text" name="idPerson" value="<?php echo "$dato[0]";?>"></Input>
            <h4>Representante Legal</h4>
            <div class="registroLargo">
                <p>Nombres:</p>
                <Input type="text" name="nombre" value="<?php echo "$dato[1]";?>" id="nombre"></Input>
            </div>
            <div class="registroLargo">
                <p>Apellidos:</p>
                <Input type="text" name="apellido" value="<?php echo "$dato[2]";?>" id="apellido"></Input>
            </div>

            <div class="registroCorto">
                <p>Cargo:</p>
                <Input type="text" name="cargo" value="<?php echo "$dato[3]";?>" id="cargo"></Input>
                <p class="segundo">Celular:</p>
                <Input type="number" name="cell" value="<?php echo "$dato[4]";?>" id="cell"></Input>
            </div>
            <div class="registroLargo">
                <p>Correo:</p>
                <Input type="text" name="correo" value="<?php echo "$dato[5]";?>" id="correo"></Input>
            </div>

            <h4>Datos de Municipalidad</h4>
            <div class="registroLargo">
                <p>Nombre de Municipio:</p>
                <Input type="text" name="nombreMunicipio" value="<?php echo "$dato[6]";?>" id="nombreMunicipio"></Input>
            </div>
            <div class="registroLargo">
                <p>Dirección:</p>
                <Input type="text" name="direccion" value="<?php echo "$dato[7]";?>" id="direccion"></Input>
            </div>
            <div class="registroCorto">
                <p>Distrito:</p>
                <Input type="text" name="distrito" value="<?php echo "$dato[8]";?>" id="distrito"></Input>
                <p class="segundo">Provincia:</p>
                <Input type="text" name="provincia" value="<?php echo "$dato[9]";?>" id="provincia"></Input>
            </div>
            <div class="registroCorto">
                <p>Región:</p>
                <Input type="text" name="region" value="<?php echo "$dato[10]";?>" id="region"></Input>
                <p class="segundo">Teléfono:</p>
                <Input type="number" name="telefono" value="<?php echo "$dato[11]";?>" id="telefono"></Input>
            </div>
            <div class="registroLargo">
                <p>Correo:</p>
                <Input type="text" name="correoMunicipal" value="<?php echo "$dato[12]";?>"
                    id="correoMunicipal"></Input>
            </div>
            <div class="registroLargo">
                <p>Página Web:</p>
                <Input type="text" name="paginaWeb" value="<?php echo "$dato[13]";?>" id="paginaWeb"></Input>
            </div>

            <div class="registroLargo estados">

                <p>Página Web:</p>
                <label class="content-input aceptado" for="aceptado">
                    <input type="radio" name="estado" id="aceptado" value="aceptado">Aceptado
                    <i></i>
                </label>
                <label class="content-input archivado" for="archivado">
                    <input type="radio" name="estado" id="archivado" value="archivado">Archivado
                    <i></i>
                </label>
                <label class="content-input rechazado" for="rechazado">
                    <input type="radio" name="estado" id="rechazado" value="rechazado">Rechazado
                    <i></i>
                </label>
                <script>
                document.querySelector("[name=estado][value=<?php echo "$dato[14]";?>]").checked = true;
                </script>
            </div>

            <div class="registroLargo">
                <input class="btnGuardar" type="submit" value="Guardar" id="validarRegistro"
                    onclick="consultaDatosRepetidos($('#nombre').val(),$('#apellido').val(),$('#correo').val())">
                <a class="btnCancelar" href="../registrarPersonal.php">Cancelar</a>
            </div>

        </form>
    </div>

    <div class="boxAlerta" id="boxAlerta" onclick="cerrarBox()">
        <div class="boxMensaje">
            <svg class="cerrar" width="24" height="24" viewBox="0 0 24 24" style="fill: white;">
                <path
                    d="M9.172 16.242 12 13.414l2.828 2.828 1.414-1.414L13.414 12l2.828-2.828-1.414-1.414L12 10.586 9.172 7.758 7.758 9.172 10.586 12l-2.828 2.828z">
                </path>
                <path
                    d="M12 22c5.514 0 10-4.486 10-10S17.514 2 12 2 2 6.486 2 12s4.486 10 10 10zm0-18c4.411 0 8 3.589 8 8s-3.589 8-8 8-8-3.589-8-8 3.589-8 8-8z">
                </path>
            </svg>

            <p id="mensajeAlerta"></p>
        </div>
    </div>
    <script type="text/javascript">
    var dNombre = "<?php echo "$dato[1]"?>";
    var dApellido = "<?php echo "$dato[2]"?>";
    var dCorreo = "<?php echo "$dato[5]"?>";

    function consultaDatosRepetidos(nombre, apellido, correo) {

        var validar = validarFormulario();
        if (validar == true) {
            var parametros = {
                "nombre": nombre,
                "apellido": apellido,
                "correo": correo
            };
            $.ajax({
                data: parametros,
                dataType: 'json',
                type: 'POST',
                url: '../php/validarNombreApellidos.php',
                success: function(data) {
                    var json_string = JSON.stringify(data);
                    //convertir el texto a un nuevo objeto
                    var obj = $.parseJSON(json_string);

                    var nombre = document.getElementById('nombre').value;
                    var apellido = document.getElementById('apellido').value;
                    var correo = document.getElementById('correo').value;

                    if ((nombre == dNombre && apellido == dApellido) || correo == dCorreo) {
                        document.getElementById("formulario").submit();
                        return;
                    }

                    if (obj.verificacion == false) {
                        var boxActivar = document.getElementById('boxAlerta');
                        var mensajeAlerta = document.getElementById('mensajeAlerta');
                        boxActivar.style.visibility = "initial";
                        mensajeAlerta.innerText =
                            "Parece que ya hay otra persona registrada con el mismo nombre y apellido";
                        return;
                    }

                    if (obj.verificacionCorreo == false) {
                        var boxActivar = document.getElementById('boxAlerta');
                        var mensajeAlerta = document.getElementById('mensajeAlerta');
                        boxActivar.style.visibility = "initial";
                        mensajeAlerta.innerText =
                            "Parece que ya hay otra persona registrada con el mismo correo";
                        return;
                    }

                    if (obj.verificacion == true && obj.verificacionCorreo == true) {
                        document.getElementById("formulario").submit();
                    }
                }
            });
        }

    }
    </script>


</body>

</html>