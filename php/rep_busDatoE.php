<?php

include("fm_conexion.php");
$buscardor = "SELECT * FROM registros WHERE (nombres LIKE LOWER('%".$_POST["buscar"]."%') AND estado LIKE LOWER('%".$_POST["estados"]."%'))  OR  (apellidos LIKE LOWER ('%".$_POST["buscar"]."%') AND estado LIKE LOWER('%".$_POST["estados"]."%')) OR (nombreMunicipio LIKE LOWER ('%".$_POST["buscar"]."%') AND estado LIKE LOWER('%".$_POST["estados"]."%'))";

$cQuery = mysqli_query($enlace,$buscardor);
?>

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

<?php while($mostrar = mysqli_fetch_assoc($cQuery)){?>

<tr class="<?php echo $mostrar['estado']?>">
    <td><?php echo $mostrar['idPerson']?></td>
    <td><?php echo $mostrar['nombres']?></td>
    <td><?php echo $mostrar['apellidos']?></td>
    <td><?php echo $mostrar['cargo']?></td>
    <td><?php echo $mostrar['celular']?></td>
    <td><?php echo $mostrar['correo']?></td>
    <td><?php echo $mostrar['nombreMunicipio']?></td>
    <td><?php echo $mostrar['direccion']?></td>
    <td><?php echo $mostrar['distrito']?></td>
    <td><?php echo $mostrar['provincia']?></td>
    <td><?php echo $mostrar['region']?></td>
    <td><?php echo $mostrar['telefono']?></td>
    <td><?php echo $mostrar['correoMunicipal']?></td>
    <td><?php echo $mostrar['paginaWeb']?></td>
    <td><?php echo $mostrar['fecha']?></td>
</tr>
<?php }?>