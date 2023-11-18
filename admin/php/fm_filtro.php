<?php

include("fm_conexion.php");

$buscardor = "SELECT idPerson, nombres, apellidos, cargo, celular, estado FROM registros WHERE nombres LIKE LOWER('%".$_POST["buscar"]."%') OR apellidos LIKE LOWER ('%".$_POST["buscar"]."%') ";

$cQuery = mysqli_query($enlace,$buscardor);
?>


<tr class="principal">
    <th>ID</th>
    <th>Nombres</th>
    <th>Apellido</th>
    <th>Cargo</th>
    <th>Celular</th>
    <th>Acciones</th>
</tr>

<?php while($mostrar = mysqli_fetch_assoc($cQuery)){?>

<tr class="<?php echo $mostrar['estado']?>">
    <td><?php echo $mostrar['idPerson']?></td>
    <td><?php echo $mostrar['nombres']?></td>
    <td><?php echo $mostrar['apellidos']?></td>
    <td><?php echo $mostrar['cargo']?></td>
    <td><?php echo $mostrar['celular']?></td>
    <td class="btnAcciones">
        <a class="btnCambio" href="php/crud_editForm.php? id=<?php echo $mostrar['idPerson']?>">
            <svg width="20" height="20" viewBox="0 0 24 24" style="fill: black">
                <path
                    d="M19.045 7.401c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.378-.378-.88-.586-1.414-.586s-1.036.208-1.413.585L4 13.585V18h4.413L19.045 7.401zm-3-3 1.587 1.585-1.59 1.584-1.586-1.585 1.589-1.584zM6 16v-1.585l7.04-7.018 1.586 1.586L7.587 16H6zm-2 4h16v2H4z">
                </path>
            </svg>
        </a>

        <a class="btnDelete" href="php/crud_eliminarRegistro.php? id=<?php echo $mostrar['idPerson']?>">
            <svg width="20" height="20" viewBox="0 0 24 24" style="fill: black">
                <path
                    d="M5 20a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8h2V6h-4V4a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v2H3v2h2zM9 4h6v2H9zM8 8h9v12H7V8z">
                </path>
                <path d="M9 10h2v8H9zm4 0h2v8h-2z"></path>
            </svg>

        </a>
    </td>
</tr>
<?php }?>