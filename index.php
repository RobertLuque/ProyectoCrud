<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/styleadhesion.css">
    <link rel="stylesheet" href="css/mensajeAlerta.css">
    <script src="js/regresar.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <title>Document</title>
</head>

<body>

    <h1>DECLARACION DE ADHESIÓN</h1>
    <div class="boxPadre">
        <div class="boxIzquierda boxRegistros">
            <form action="php/registros.php" method="post" autocomplete="off" id="formulario">
                <h4>Representante Legal</h4>
                <div class="registroLargo">
                    <p>Nombres:</p>
                    <Input type="text" name="nombre" id="nombre"></Input>
                </div>
                <div class="registroLargo">
                    <p>Apellidos:</p>
                    <Input type="text" name="apellido" id="apellido"></Input>
                </div>

                <div class="registroCorto">
                    <p>Cargo:</p>
                    <Input type="text" name="cargo" id="cargo"></Input>
                    <p class="segundo">Celular:</p>
                    <Input type="number" name="cell" id="cell"></Input>
                </div>
                <div class="registroLargo">
                    <p>Correo:</p>
                    <Input type="text" name="correo" id="correo"></Input>
                </div>

                <h4>Datos de Municipalidad</h4>
                <div class="registroLargo">
                    <p>Nombre de Municipio:</p>
                    <Input type="text" name="nombreMunicipio" id="nombreMunicipio"></Input>
                </div>
                <div class="registroLargo">
                    <p>Dirección:</p>
                    <Input type="text" name="direccion" id="direccion"></Input>
                </div>
                <div class="registroCorto">
                    <p>Distrito:</p>
                    <Input type="text" name="distrito" id="distrito"></Input>
                    <p class="segundo">Provincia:</p>
                    <Input type="text" name="provincia" id="provincia"></Input>
                </div>
                <div class="registroCorto">
                    <p>Región:</p>
                    <Input type="text" name="region" id="region"></Input>
                    <p class="segundo">Teléfono:</p>
                    <Input type="number" name="telefono" id="telefono"></Input>
                </div>
                <div class="registroLargo">
                    <p>Correo:</p>
                    <Input type="text" name="correoMunicipal" id="correoMunicipal"></Input>
                </div>
                <div class="registroLargo">
                    <p>Página Web:</p>
                    <Input type="text" name="paginaWeb" id="paginaWeb"></Input>
                </div>

                <div class="registroLargo">
                    <input class="btnRegistrar" type="submit" value="Registrarse" id="validarRegistro"
                        onclick="consultaDatosRepetidos($('#nombre').val(),$('#apellido').val(),$('#correo').val())"></input>
                </div>
            </form>
        </div>
        <div class=" boxDerecha boxInformacion">
            <h2>El Alcalde deberá presentar posteriormente un Acuerdo de Concejo Municipal</h2>
            <h3>Declaración Jurada:</h3>
            <p>Yo, el Alcalde, declaro formalmente la adhesión de la Municipalidad de la que soy representante
                legal a
                la Federación de Municipios Libres del Perú-FEMULP, suscribiendo su Manifiesto Fundacional,
                Estatutos y
                comprometiéndome a participar en sus actividades y sostenibilidad institucional.</p>
            <p>Remitir a FEMULP con sello y firma.</p>
            <p>
                <FONT COLOR="red">NOTA IMPORTANTE:</FONT> No olvide enviar a FEMULP su Acuerdo de Concejo
                Municipal y su Credencial de Alcalde.
            </p>
        </div>
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
    function consultaDatosRepetidos(nombre, apellido, correo) {
        alert('buenas tardes');
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
                url: 'php/validarNombreApellidos.php',
                success: function(data) {
                    var json_string = JSON.stringify(data);
                    //convertir el texto a un nuevo objeto
                    var obj = $.parseJSON(json_string);

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