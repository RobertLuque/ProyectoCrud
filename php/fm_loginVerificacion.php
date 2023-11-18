<?php
include("fm_conexion.php");

//Codigo sql
$sql = "SELECT usuario, contrasenia FROM users";
$cQuery = mysqli_query($enlace,$sql);
//Validar
//Para contar cuantos datos hay
$icont = 0;

if(!empty($_POST['btningre'])){
    if(empty($_POST['usuario']) or empty($_POST['contrasenia'])){
        echo "<div class='mensajeAlert'>Alguno de los campos estan vacios</div>";
    }else{
        $user = $_POST['usuario'];
        $contra =  $_POST['contrasenia'];

        while($mostrar = mysqli_fetch_row($cQuery)){
            if($user == $mostrar[0] and $contra == $mostrar[1]){
                header("Location: opFemult.php");
            }elseif($icont == count($mostrar)){
                echo "<div class='mensajeAlert'>Los datos ingresados son incorrectos</div>";
            }else{
                $icont++;
            }
        }
    }
}
?>