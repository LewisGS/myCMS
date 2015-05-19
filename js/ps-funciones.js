
//funcion para cambiar la imagen al pasar el raton mediante el atributo 
function cambiarImagen(identificador, ruta) {

    $("#" + identificador).attr("src", ruta);
}

//funcion para cambiar la clase o eliminarla y de esta forma aparezca o no un icono
function cambiaIcono(identificador) {


    $("#" + identificador).slideToggle('slow');
}


function quitaIcono(identificador) {

$("#" + identificador).hide();
        }



function notificacion()
{
    nombre = document.contactform.nombre;
    email = document.contactform.email;
    comentarios = document.contactform.comentarios;
    
    var notificacion = "";
  
}



































