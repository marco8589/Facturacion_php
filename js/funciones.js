
function enviarformulario() {
    var nombre = document.getElementById('nombre');
    var correo = document.getElementById('correo');
    var usuario = document.getElementById('usuario');
    var clave = document.getElementById('clave');
    var rol = document.getElementById('rol');

    var alerta = document.getElementById('alerta');

    var mensaje = '';

    var expReg= /^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/;
    if (nombre.value === null || nombre.value === '') {
        mensaje = 'Debe digitar el nombre';
        alerta.innerHTML ='<p class="msg_error">'+mensaje+'</p>';
        return false;
    }
    if (correo.value === null || correo.value === '') {
        mensaje = 'Debe digitar el correo';
        alerta.innerHTML ='<p class="msg_error">'+mensaje+'</p>';
        return false;

    }else{
        if(expReg.test(correo.value)==false){
            mensaje = 'El correo no es valido';
            alerta.innerHTML ='<p class="msg_error">'+mensaje+'</p>';
            return false;
        }
    }
    if (usuario.value === null || usuario.value === '') {
        mensaje = 'Debe digitar el usuario';
        alerta.innerHTML ='<p class="msg_error">'+mensaje+'</p>';
        return false;
    }
    if (clave.value === null || clave.value === '' || clave.value.trim() === '') {
        mensaje = 'Debe digitar la clave';
        alerta.innerHTML ='<p class="msg_error">'+mensaje+'</p>';
        return false;
    }
    if (rol.value === null || rol.value === '') {
        mensaje = 'Debe seleccionar el rol';
        alerta.innerHTML ='<p class="msg_error">'+mensaje+'</p>';
        return false;
    }
   // console.log(alert.innerHTML);
  

    return true;
}




function enviarformulario_cliente() {

    var nit = document.getElementById('nit');
    var nombre = document.getElementById('nombre');
    var telefono = document.getElementById('telefono');
    var direccion = document.getElementById('direccion');

    var alerta = document.getElementById('alerta');

    var mensaje = '';

    if (nit.value === null || nit.value === '') {
        mensaje = 'Debe digitar el nit';
        alerta.innerHTML ='<p class="msg_error">'+mensaje+'</p>';
        return false;
    }

    if (nombre.value === null || nombre.value === '') {
        mensaje = 'Debe digitar el nombre';
        alerta.innerHTML ='<p class="msg_error">'+mensaje+'</p>';
        return false;
    }

    if (telefono.value === null || telefono.value === '') {
        mensaje = 'Debe digitar el telefono';
        alerta.innerHTML ='<p class="msg_error">'+mensaje+'</p>';
        return false;

    }

    if (direccion.value === null || direccion.value === '') {
        mensaje = 'Debe digitar la direccion';
        alerta.innerHTML ='<p class="msg_error">'+mensaje+'</p>';
        return false;
    }


    return true;
}


