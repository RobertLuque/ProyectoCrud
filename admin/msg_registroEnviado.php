<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Envio Exitoso</title>
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/registro.css">
</head>

<body>
    <div class="boxCenter">
        <h1>El registro se envio de manera exitosa</h1>
        <h2>Gracias por Registrarte</h2>
    </div>
    <script>
    //Esto es para que estea por un par de segundos y despues regresa a la parte de registros
    setInterval(function() {
        window.location = "registrarPersonal.php";
    }, 3000);
    </script>
</body>

</html>