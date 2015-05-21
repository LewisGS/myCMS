
<?php
$directorioInicial = "./";    //Especifica el directorio a leer
$rep = opendir($directorioInicial);    //Abrimos el directorio
echo "<div class='button' id='mostrar'>Mostrar archivos</div>";
echo "<div id='acordeon' class='propiedadesCaja'>";
echo "<ul>";
while ($todosArchivos = readdir($rep)) {  //Leemos el arreglo de archivos contenidos en el directorio: readdir recibe como parametro el directorio abierto
    if ($todosArchivos != '..' && $todosArchivos != '.' && $todosArchivos != '' && strpos($todosArchivos, '.html') && !is_dir($todosArchivos)) {

        echo "<li class='listaPaginas' ><a class='listado' href=" . $todosArchivos . " target='probando'>" . $todosArchivos . "</a></li>"; //Imprimimos el nombre del archivo con un link
//    . $directorioInicial . "/"
    }
}
closedir($rep);     //Cerramos el directorio
clearstatcache();    //Limpia la caché de estado de un archivo
echo "</ul>";
echo "</div>";

// $url = "index.html";
$url = "prueba2.html";
try{
if (isset($_POST['textarea'])) {

    // means submit clicked!
    $url = $_POST['textareaPagina'];
    $salida = $_POST['textarea'];
    
    $archivo = fopen($url, "w+");
    fputs($archivo, $salida).fopen($archivo, "w+");


    fclose($archivo);
    clearstatcache();
}
}catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
}
?>

<html>
    <head>
        <title>index</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--        librerias jquery UI-->
        <link rel='stylesheet' href="css/jquery-ui.css">
        <link rel='stylesheet' href="css/jquery-ui.min.css">
        <link rel='stylesheet' href="css/jquery-ui.structure.css">
        <link rel='stylesheet' href="css/jquery-ui.structure.min.css">
        <link rel='stylesheet' href="css/jquery-ui.theme.css">
        <link rel='stylesheet' href="css/jquery-ui.theme.min.css">

        <link rel="stylesheet" type="text/css" href="estiloP.css">

        <link rel="stylesheet" type="text/css" href="dist/sweetalert.css">

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    </head>
    <body>
        <div>
            <h3>Haga "click" encima del contenido a modificar y confirme los cambios</h3>
        </div>


        <form id="formulario" name="formulario" action="" method="POST" enctype="multipart/form-data"> 


            <div>
                <input class="button" id="botonGuardar" type="submit" name="submit" value="Confirmar cambios realizados" />
            </div>


            <div class="contenedor-responsive position">
                <center><iframe  id="probando" src="<?php echo $url; ?>" scrolling="auto" height="700" width="700" marginheight="0" marginwidth="0" name="probando"></iframe></center>
            </div>
              <textarea id="url" name="textareaPagina" rows="4" cols="50"><?php echo $url; ?></textarea>
            <textarea id="contenido" name="textarea" rows="4" cols="50" style="display:none;"></textarea>

        </form>

     





            <script src="dist/sweetalert.min.js"></script> 


            <script type="text/javascript">


                $(document).ready(function () {

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
                    });

                    //
                    //                Esto nos va a permitir recoger en una variable el nombre del fichero
                    //                al que nosotros accedamos y despues meterlo en un textarea para mandarselo
                    //                al servidor
                    $(".listaPaginas").click(function (e) {
                        var li = ($(e.target).attr("href"));
                        $("#url").text(li);
                        console.log($("textareaPagina").text());
                    });





                    //                Aqui cargamos el iframe llamando a su identificador
                    $("#probando").load(function () {

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
                                    return false;
                                }
                                swal("¡Muy bien!", "Nuevo texto: " + inputValue, "success");
                                $(e.target).text(inputValue);
                                var contenido = $("#probando").contents().find('html').prop('outerHTML');
                                $("#contenido").text(contenido);
                            });
                        });



                        //                    Cambiamos la imagen al hacer click sobre ella, y poniendo la 
                        //                    nueva ruta deseada.
                        $("#probando").contents().find("img").on("click", function (e) {
                            console.log(e);
                            swal({
                                title: "Nueva imagen",
                                text: "Escribe la nueva ruta:",
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
                                    return false;
                                }
                                swal("¡Muy bien!", "Ruta de la nueva imagen: " + nuevaImagen, "success");
                                $(e.target).attr('src', nuevaImagen);
                                var contenido = $("#probando").contents().find('html').prop('outerHTML');
                                $("#contenido").text(contenido);
                            });
                        });












                    });
                });
            </script>



    </body>
</html>