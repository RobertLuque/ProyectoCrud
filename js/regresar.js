//*Con esta funcion se evita que sucede el evento submit que es el evento submit es
//*Para realizar el envio de datos a php para validar el formulario
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("formulario").addEventListener('submit', detener);
});

function detener(event) {
    event.preventDefault();
}

function validarFormulario() {
    var nombre = document.getElementById('nombre').value;
    var apellido = document.getElementById('apellido').value;
    var cargo = document.getElementById('cargo').value;
    var cell = document.getElementById('cell').value;
    var correo = document.getElementById('correo').value;
    var nombreMunicipio = document.getElementById('nombreMunicipio').value;
    var direccion = document.getElementById('direccion').value;
    var distrito = document.getElementById('distrito').value;
    var provincia = document.getElementById('provincia').value;
    var region = document.getElementById('region').value;
    var telefono = document.getElementById('telefono').value;
    var correoMunicipal = document.getElementById('correoMunicipal').value;
    var paginaWeb = document.getElementById('paginaWeb').value;

    var f = false;
    var t = true;
    //*Otras variables
    var emailverificacion = /^(?:[^<>()[\].,;:\s@"]+(\.[^<>()[\].,;:\s@"]+)*|"[^\n"]+")@(?:[^<>()[\].,;:\s@"]+\.)+[^<>()[\]\.,;:\s@"]{2,63}$/i;
    var boxActivar = document.getElementById('boxAlerta');
    var mensajeAlerta = document.getElementById('mensajeAlerta');

    if(nombre.length == 0 || nombre.length >= 1 || apellido.length == 0 || apellido.length >= 1) {
        if(nombre.length == 0){
            boxActivar.style.visibility ="initial";
            mensajeAlerta.innerText = "El campo nombre esta vacio";
            return f;
        }
        if(apellido.length == 0){
            boxActivar.style.visibility ="initial";
            mensajeAlerta.innerText = "El campo apellido esta vacio";
            return f;
        }

    }


    if(cargo.length == 0){
        boxActivar.style.visibility ="initial";
        mensajeAlerta.innerText = "El campo cargo esta vacio";
        return f;
    }

    if((cell.length <=8 || cell.length >=10) || cell.length == 0){
        boxActivar.style.visibility ="initial";
        if(cell.length == 0){
            mensajeAlerta.innerText = "El campo celular esta vacio";
        }else{
            mensajeAlerta.innerText = "El campo celular tiene mas o menos digitos";
        }
        return f;
    }

    if(emailverificacion.test(correo) == false || correo.length == 0){
        boxActivar.style.visibility ="initial";
        if(correo.length == 0){
            mensajeAlerta.innerText = "La campo correo esta vacio";
        }else{
            mensajeAlerta.innerText = "En el campo correo se ingreso un correo invalido";
        }
        return f;
    }

    if(nombreMunicipio.length == 0){
        boxActivar.style.visibility ="initial";
        mensajeAlerta.innerText = "El campo municipio esta vacio";
        return f;
    }

    if(direccion.length == 0){
        boxActivar.style.visibility ="initial";
        mensajeAlerta.innerText = "El campo direccion esta vacio";
        return f;
    }

    if(distrito.length == 0){
        boxActivar.style.visibility ="initial";
        mensajeAlerta.innerText = "El campo distrito esta vacio";
        return f;
    }


    if(provincia.length == 0){
        boxActivar.style.visibility ="initial";
        mensajeAlerta.innerText = "El campo provincia esta vacio";
        return f;
    }
    if(region.length == 0){
        boxActivar.style.visibility ="initial";
        mensajeAlerta.innerText = "El campo region esta vacio";
        return f;
    }

    if((telefono.length <=8 || telefono.length >=10) || telefono.length == 0 ){
        boxActivar.style.visibility ="initial";
        if(telefono.length == 0){
            mensajeAlerta.innerText = "El campo telefono esta vacio";
        }else{
            mensajeAlerta.innerText = "El campo telefono tiene mas o menos digitos";
        }
        return f;
    }


    if(emailverificacion.test(correoMunicipal) == false || correoMunicipal.length == 0){
        boxActivar.style.visibility ="initial";
        if(correoMunicipal.length == 0){
            mensajeAlerta.innerText = "El campo del correo Municipal esta vacio";
        }else{
            mensajeAlerta.innerText = "En el campo correo Municipal se ingreso un correo invalido";
        }
        return f;
    }

    if(paginaWeb.length == 0){
        boxActivar.style.visibility ="initial";
        mensajeAlerta.innerText = "El campo pagina Web esta vacio";
        return f;
    }
return t;
}


function cerrarBox(){
    var boxActivar = document.getElementById('boxAlerta');
    boxActivar.style.visibility ="hidden";
}