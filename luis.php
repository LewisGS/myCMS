<?php
header("X-XSS-Protection: 0");

$directorioInicial = "./";    //Especifica el directorio a leer
$rep = opendir($directorioInicial);    //Abrimos el directorio
//Creación del array vacio
$listaHtml = array();

while ($todosArchivos = readdir($rep)) {  //Leemos el arreglo de archivos contenidos en el directorio: readdir recibe como parametro el directorio abierto
    if ($todosArchivos != '..' && $todosArchivos != '.' && $todosArchivos != '' && strpos($todosArchivos, '.html') && !is_dir($todosArchivos)) {

//Introduccion dentro del array de todos los archivos encontrados
        $listaHtml[] = $todosArchivos;
    }
}

closedir($rep);     //Cerramos el directorio
clearstatcache();    //Limpia la caché de estado de un archivo
//    Declaracion de la variable "url" dandola una dirección inicial
$url = "prueba2.html";

//    Condicion que va a comprobar si existe algo dentro de este textarea
if (isset($_POST['textarea'])) {

//    Recibimos lo introducido en los textarea ocultos y lo asignamos a las 
//    siguientes variables de php
    $url = $_POST['textareaPagina'];
    $salida = $_POST['textarea'];

//    Abrimos el archivo y le damos permisos de escritura
    $archivo = fopen($url, "w+");
    fwrite($archivo, $salida);

//    cerramos el archivo y limpiamos la cache
    fclose($archivo);
    clearstatcache();
}
?>
<html>
    <head>
        <title>Gestor</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--        librerias jquery UI-->
        <link rel='stylesheet' href="css/jquery-ui.css">
        <link rel='stylesheet' href="css/jquery-ui.min.css">
        <link rel='stylesheet' href="css/jquery-ui.structure.css">
        <link rel='stylesheet' href="css/jquery-ui.structure.min.css">
        <link rel='stylesheet' href="css/jquery-ui.theme.css">
        <link rel='stylesheet' href="css/jquery-ui.theme.min.css">

        <!--        Estilos de los botones y divs--> 
        <link rel="stylesheet" type="text/css" href="LS-css/estilosCMS.css">

        <!--        Estilo para las ventanas modales emergentes-->
        <link rel="stylesheet" type="text/css" href="dist/sweetalert.css">   

        <!--        Estilo del header-->
        <link rel="stylesheet" type="text/css" href="LS-css/headerStyles.css"> 

        <!--        Estilo botones-->
        <link rel="stylesheet" type="text/css" href="LS-css/btnStyles.css">
        <!--        Estilo del footer-->
        <link rel="stylesheet" type="text/css" href="LS-css/footerStyles.css"> 

        <!--        Media query para el titulo-->
        <link rel="stylesheet" type="text/css" href="LS-css/mediaQuery.css">

        <!--        Cogeremos de forma remota los iconos-->
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>


        <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
        <link href='http://weloveiconfonts.com/api/?family=entypo' rel='stylesheet' type='text/css'>

        <meta http-Equiv="Cache-Control" Content="no-cache">
        <meta http-Equiv="Pragma" Content="no-cache">
        <meta http-Equiv="Expires" Content="0">
    </head>
    <body>
        <!--        Cabecera que permanecera oculta hasta que con JQuery la mostremos-->
        <header style="display:none;"> 


            <!--    Imagen que nos llevara al repositorio de GutHub-->
            <a class="github" href="https://github.com/LewisGS/myCMS.git" target="_blank">
                <img src="https://s3.amazonaws.com/github/ribbons/forkme_right_darkblue_121621.png" alt="Fork me on GitHub">
            </a>

            <div class="container">
                <h1 id="titulo">GESTOR DE CONTENIDOS</h1>
            </div>
            <div id="titulo">
                <p>Haga click en el elemento a modificar</p>
            </div>

        </header>

        <!--        Comienzo del formulario-->
        <form id="formulario" name="formulario" action="" method="POST" enctype="multipart/form-data" > 

            <div class="container">
                <input class="button" id="mostrar" type="button" name="mostrar" value="Mostrar archivos"  />
                <input class=" botonGuardar" id="botonGuardar" type="submit"  name="submit"  value="Confirmar cambios*" disabled>
                <input class="" id="deshacer" type="button"  value="Deshacer cambios" disabled/>                
            </div>

            <div class="propiedadesCaja" id="acordeon" style="display:none;">
                <ul class="contenedorUl">
                    <!--     Código PHP incrustado en HTML que nos va a crear una lista con los archivos-->
                    <?php foreach ($listaHtml as $i): ?>

                        <li class="listaPaginas lista" >
                            <a class="listado" href="<?php echo $i; ?>" target="probando"><?php echo $i; ?></a>
                        </li>   

                    <?php endforeach; ?>

                </ul>
            </div>

            <div class="pRoja"><p>*Si tu elemento no se ha modificado vuelve a cargar la página.</p></div>


            <!--<button type="button" disabled>Click Me!</button>-->

            <div class="contenedor-responsive ">

                <iframe  id="probando" src="<?php echo $url; ?>"  name="probando"></iframe>
            </div>
            <textarea id="url" name="textareaPagina" rows="4" cols="50" style="display:none;"><?php echo $url; ?></textarea>
            <textarea id="contenido" name="textarea" rows="4" cols="50" style="display:none;"></textarea>

        </form>

        <footer>
            <div class="container">
                <div class="copyright col-xs-12 col-sm-3 col-md-3">
                    Copyright © Salgado & Co. 2015
                </div>

                <!--        Iconos de las redes sociales que tenemos en el pie de página-->
                <div id="social">
                    <i class="fa fa-facebook-square fa-4x fb"></i> 
                    <i class="fa fa-twitter-square fa-4x twt"></i>  
                    <i class="fa fa-linkedin-square fa-4x lkdIn"></i>
                    <i class="fa fa-google-plus-square fa-4x gPlus"></i>  
                </div>

            </div>

            <!--    Botón que nos va a llevar de vuelta a la cabecera-->
            <div>
                <a class="go-top">Subir</a>
            </div>

        </footer>

        <!--        Archivo de JavaScript que nos va a permitir utilizar las ventanas modales-->
        <script src="dist/sweetalert.min.js"></script>
        
        <script src="LS-js/headerScript.js"></script>
        <script src="LS-js/bootstrap-datepicker.js"></script>
        <script src="LS-js/bootstrap.min.js"></script>
        <script src="LS-js/bootstrapValidator.min.js"></script>
        <script src="js/jquery-ui.js"></script>
        <script src="js/jquery-ui.min.js"></script>

        <script type="text/javascript">

            $(document).ready(function () {

//                Esto es lo que va a hacer que al mostrar la cabecera se haga ese efecto (fold)
                $("header").show("fold", 3500);
                

//              Le damos un efecto de salida distinto al h1 metiendo  los siguientes
//              valores dentro de un objeto

                $("h1").hide().animate({
                    rigth: "",
                    width: "toggle"
                }, 10000, function () {
                });

//            Apartado en el que se refresca el iframe cuando hacemos
//            click en el botón de guardar.
                $("#botonGuardar").click(function () {
//                $('#probando').contentWindow.location.reload(true);
                    location.reload();

                });

//          Aquí es donde le vamos a decir al boton cuando tiene que aparecer
                $(window).scroll(function () {
                    if ($(this).scrollTop() > 200) {
                        $('.go-top').fadeIn(200);
                    } else {
                        $('.go-top').fadeOut(200);
                    }
                });

                // Este es el botón que nos va a devolver a la cabecera
                $('.go-top').click(function (event) {
                    event.preventDefault();
                    $('html, body').animate({scrollTop: 0}, 300);
                });


//                Funcion que nos permite volver atras con los cambios por si 
//                acaso no nos gusta lo que hemos escrito
                $("#deshacer").on("click", function () {
                    swal({title: "¿Estas seguro?", text: "¡Dejaremos las cosas como al principio!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "¡Si, eliminar!",
                        cancelButtonText: "¡No, espera!",
                        closeOnConfirm: false,
                        closeOnCancel: false},
                    function (isConfirm) {
                        if (isConfirm) {
                            swal("¡Volviendo atras!", "Las cosas estan como antes", "success");
                            location.reload();
                        } else {
                            swal("¡Cancelar!", "Piensatelo mejor...", "error");
                        }
                    });

                });


                //                Primero escondemos la lista para que no se muestre hasta
                //                que no hagamos "click" en el botón de mostrar
                $("#acordeon").hide();
                $("#mostrar").click(function () {
                    $("#acordeon").toggle({
                        duration: 1050
                    });
                });

                //                Con esta funcion vamos a controlar que el textarea no se mande vacío
                //                y nos quede la página en blanco
                $("#botonGuardar").click(function () {

                    if ($("#contenido").val().length < 1) {
                        swal({title: "¡Cuidado!", text: "No has realizado ningun cambio"});
                        return false;
                    }

//                    $("#probando").src = $("#probando").src;
                });

                //                Esto nos va a permitir recoger en una variable el nombre del fichero
                //                al que nosotros accedamos y despues meterlo en un textarea para mandarselo
                //                al servidor
                $(".listaPaginas").click(function (e) {
                    var li = ($(e.target).attr("href"));
                    $("#url").text(li);
                    console.log($("textareaPagina").text());
                });

                //                Aqui cargamos el iframe llamando a su identificador
                $("#probando").on('load', function () {

                    //                    Cambiamos cualquier de todas las etiquetas aqui marcadas 
                    //                      en las que se ha hecho click.

                    $("#probando").contents().find("p,h1,h2,h3,h4,h5,h6,span,ul,li,a").on("click", function (e) {

                        swal({
                            title: "Nuevo texto",
                            text: "Escribe el texto deseado:",
                            type: "input",
                            showCancelButton: true,
                            closeOnConfirm: false,
                            animation: "slide-from-top",
                            inputPlaceholder: "Nuevo texto"},
                        function (inputValue) {

                            if (inputValue === false)
                                return false;
                            if (inputValue === "") {
                                swal.showInputError("¡No has escrito nada!");
                                return false
                            }
                            swal("¡Muy bien!", "Nuevo texto: " + inputValue, "success");
                            $(e.target).text(inputValue);
                            $("#deshacer").prop("disabled", false).addClass("button");
                            $("#botonGuardar").prop("disabled", false).addClass("button");

                            var contenido = $("#probando").contents().find('html').prop('outerHTML');
                            $("#contenido").text(contenido);


                        });

                    });


                    //                    Cambiamos la imagen al hacer click sobre ella, y poniendo la 
                    //                    nueva ruta deseada.
                    $("#probando").contents().find("img").on("click", function (e) {
                        swal({
                            title: "Escribe la ruta de la imagen",
                            text: "Ejemplo: carpeta/nombreImagen.jpg ",
                            type: "input",
                            showCancelButton: true,
                            closeOnConfirm: false,
                            animation: "slide-from-top",
                            inputPlaceholder: "Nuevo texto"},
                        function (nuevaImagen) {
                            if (nuevaImagen === false)
                                return false;
                            if (nuevaImagen === "") {
                                swal.showInputError("¡No has escrito nada!");
                                return false
                            }
                            swal("¡Muy bien!", "Ruta de la nueva imagen: " + nuevaImagen, "success");
                            $(e.target).attr('src', nuevaImagen);
                            $("#deshacer").prop("disabled", false);
                            $("#deshacer").prop("disabled", false).addClass("button");
                            $("#botonGuardar").prop("disabled", false).addClass("button");
                            var contenido = $("#probando").contents().find('html').prop('outerHTML');

                            $("#contenido").text(contenido);
                            $("#deshacer").prop("disabled", false);

                        });
                    });

                });
            });
        </script>
    </body>
</html>