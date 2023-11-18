<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema femlp</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/general.css">
</head>

<body>
    <div class="boxLogin">
        <div class="login">
            <h1>Inicio de Sesion</h1>
            <img src="img/bandera-femulp.webp" alt="">

            <form action="" method="post" autocomplete="off">
                <div class="registroLargo">
                    <p>Usuario</p>
                    <Input type="text" name="usuario"></Input>
                </div>
                <div class="registroLargo">
                    <p>Contraseña</p>
                    <Input type="text" name="contrasenia"></Input>
                </div>
                <div class=" registroLargo btnCenter">
                    <input class="btnIngresar" name="btningre" type="submit" value="Iniciar Sesion">
                </div>
                <?php
                include("php/fm_loginVerificacion.php");
                ?>
            </form>


        </div>
    </div>
</body>

</html>