<?php
$directorioInicial = "./";    //Especifica el directorio a leer
$rep = opendir($directorioInicial);    //Abrimos el directorio
echo "<div id='acordeon'>";
echo "<ul>";
while ($todosArchivos = readdir($rep)) {  //Leemos el arreglo de archivos contenidos en el directorio: readdir recibe como parametro el directorio abierto
    if ($todosArchivos != '..' && $todosArchivos != '.' && $todosArchivos != '' && $todosArchivos != 'index.php' && $todosArchivos != '.git') {
        echo "<div>";
        echo "<li>";
//$arc Contiene el nombre del archivo contenido dentro del directorio     
        echo '<p>'."/"."<a href=" . $directorioInicial . "/" . $todosArchivos . " target='probando'>" . $todosArchivos . "</a></p><br />"; //Imprimimos el nombre del archivo con un link
        echo "</li>";
        echo "</div>";
    }
}
closedir($rep);     //Cerramos el directorio
//clearstatcache();    //Limpia la caché de estado de un archivo
echo "</ul>";
echo "</div>";


$url = '';

if (isset($_POST['textarea'])) {
    // means submit clicked!

    $salida = $_POST['textarea'];

    $archivo = fopen($url, "w");
    fputs($archivo, $salida);



    fclose($archivo);
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

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    </head>
    <body>
        <div>
            <h3>Haga "click" encima del contenido a modificar</h3>
        </div>


        <form id="formulario" action="" method="POST" enctype="multipart/form-data"> 


            <div>
                <input class="button" id="botonGuardar" type="submit" name="submit" value="Confirmar cambios realizados" />
            </div>


            <div class="contenedor-responsive position">
                <center><iframe  id="probando" src="<?php echo $url; ?>" scrolling="auto" height="700" width="700" marginheight="0" marginwidth="0" name="probando"></iframe></center>
            </div>
            <textarea name="textarea" rows="4" cols="50" style="display:none;"></textarea>

        </form>


        <script type="text/javascript">






            $(document).ready(function () {




                $("#probando").load(function () {

//                    Cambiamos cualquier de todas las etiquetas aqui marcadas 
//                      en las que se ha hecho click.

                    $("#probando").contents().find("p,h1,h2,h3,h4,h5,h6,span").on("click", function () {

                        var textoIntroducido = prompt("Introduce el contenido nuevo: ");
                        $(this).text(textoIntroducido);
                        var contenido = $("#probando").contents().find('html').prop('outerHTML');
                        $("textarea").text(contenido);
                    });


//                    Cambiamos la imagen al hacer click sobre ella, y poniendo la 
//                    nueva ruta deseada
                    $("#probando").contents().find("img").click(function () {
                        $(this).attr('src', prompt('Introduce la nueva ruta de la imagen deseada :'));
                        var contenido = $("#probando").contents().find('html').prop('outerHTML');
                        $("textarea").text(contenido);

                    });
                });










            });
        </script>



    </body>
</html>