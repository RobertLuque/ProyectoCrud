<?php
    for($i = 0 ; $i <= 250; $i++){
        $numberRand=rand(1,3);

        switch ($numberRand) {
            case 1:
                $estado = "aceptado";
                break;
            case 2:
                $estado = "archivado";
                break;
            case 3:
                $estado = "rechazado";
                break;
        }

        $numberAnio=rand(1,3);

        switch ($numberAnio) {
            case 1:
                $anio = 2021;
                break;
            case 2:
                $anio = 2022;
                break;
            case 3:
                $anio = 2023;
                break;
        }

        $numberMes=rand(1,12);
        if($numberMes < 10){
            $numberMes = "0$numberMes";
        }
        $numberDia=rand(1,28);
        if($numberDia < 10){
            $numberDia = "0$numberDia";
        }

        $numberHoras = rand(1,23);
        if($numberHoras < 10){
            $numberHoras = "0$numberHoras";
        }

        $numberMinutos = rand(1,50);
        if($numberMinutos < 10){
            $numberMinutos = "0$numberMinutos";
        }

        $numberSegundos=rand(1,50);
        if($numberSegundos < 10){
            $numberSegundos = "0$numberSegundos";
        }


        $fecha = "$anio-$numberMes-$numberDia $numberHoras:$numberMinutos:$numberSegundos";


        //Municipio Datos :v
        $randMuni=rand(1,6);

        switch ($randMuni) {
            case 1:
                $nombreMuni = 'Municipalidad del Callao';
                $direccion = 'Callao';
                $distrito = 'Callao';
                $provincia = 'Callao';
                $region = 'Callao';
                $telefono = '123123123';
                $correoMunicipal = 'municallao@gmail.com';
                $paginaWeb = 'municallao.com';
                break;
            case 2:
                $nombreMuni = 'Municipalidad de Lima';
                $direccion = 'Lima';
                $distrito = 'Lima';
                $provincia = 'Lima';
                $region = 'Lima';
                $telefono = '123456789';
                $correoMunicipal = 'munilima@gmail.com';
                $paginaWeb = 'munilima.com';
                break;
            case 3:
                $nombreMuni = 'Municipalidad de San Juan de Miraflores';
                $direccion = 'San Juan de Miraflores';
                $distrito = 'San Juan de Miraflores';
                $provincia = 'San Juan de Miraflores';
                $region = 'San Juan de Miraflores';
                $telefono = '1111111111';
                $correoMunicipal = 'munisanjuanmiraflores@gmail.com';
                $paginaWeb = 'munisanjuanraflores.com';
                break;
            case 4:
                $nombreMuni = 'Municipalidad Bellavista';
                $direccion = 'Bellavista';
                $distrito = 'Bellavista';
                $provincia = 'Bellavista';
                $region = 'Bellavista';
                $telefono = '222222222';
                $correoMunicipal = 'munibellavista@gmail.com';
                $paginaWeb = 'munibellavista.com';
                break;
            case 5:
                $nombreMuni = 'Municipalidad de Breña';
                $direccion = 'Barranco';
                $distrito = 'Breña';
                $provincia = 'Lima';
                $region = 'Lima';
                $telefono = '333333333';
                $correoMunicipal = 'munibrenia@gmail.com';
                $paginaWeb = 'munibrenia.com';
                break;
            case 6:
                $nombreMuni = 'Municipalida de Comas';
                $direccion = 'Comas';
                $distrito = 'Comas';
                $provincia = 'Lima';
                $region = 'Lima';
                $telefono = '44444444';
                $correoMunicipal = 'municomas@gmail.com';
                $paginaWeb = 'municomas.com';
                break;
        }

        echo "INSERT INTO `registros`(`idPerson`, `nombres`, `apellidos`, `cargo`, `celular`, `correo`, `nombreMunicipio`, `direccion`, `distrito`, `provincia`, `region`, `telefono`, `correoMunicipal`, `paginaWeb`, `estado`,`fecha`) VALUES (NULL,'nombre$i','apellido$i','Trabajador',123456789,'persona$i@gmail.com','$nombreMuni','$direccion','$distrito','$provincia','$region','$telefono','$correoMunicipal','$paginaWeb','$estado', '$fecha'); <br>";
    }

        ?>