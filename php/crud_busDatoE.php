<?php
    $id = $_GET['id'];
    include("fm_conexion.php");
    //Codigo sql
    $sql = "SELECT * FROM registros WHERE idPerson='$id'";
    $cQuery = mysqli_query($enlace,$sql);

    $dato= mysqli_fetch_array($cQuery);
    ?>