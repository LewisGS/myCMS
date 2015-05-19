<?php


$url = 'prueba2.html';

if (isset($_GET['textarea'])) {
    // means submit clicked!

    $salida = $_GET['textarea'];

    $archivo = fopen($url, "w+");
    fputs($archivo, $salida);



    fclose($archivo);
}

$directorioInicial = "./";    //Especifica el directorio a leer
$rep = opendir($directorioInicial);    //Abrimos el directorio
echo "<ul>";
while ($todosArchivos = readdir($rep)) {  //Leemos el arreglo de archivos contenidos en el directorio: readdir recibe como parametro el directorio abierto
    if ($todosArchivos != '..' && $todosArchivos != '.' && $todosArchivos != '' ) {
        echo "<li>";
//$arc Contiene el nombre del archivo contenido dentro del directorio
     
        echo "<a href=" . $directorioInicial . "/" . $todosArchivos . " target='probando'>" . $todosArchivos . "</a><br />"; //Imprimimos el nombre del archivo con un link
        echo "</li>";
    }
}
closedir($rep);     //Cerramos el directorio
clearstatcache();    //Limpia la caché de estado de un archivo
echo "</ul>";


?>

<html>
    <head>
        <title>index</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" type="text/css" href="estiloP.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    </head>
    <body>
        <div>
            <h3>Haga "click" encima del contenido a modificar</h3>
        </div>


        <form id="formulario" action="" method="GET" enctype="multipart/form-data"> 


            <div>
                <input id="botonGuardar" type="submit" name="submit" value="Confirmar cambios" />
            </div>



            <iframe id="probando" src="<?php echo $url; ?>" scrolling="auto" height="700" width="800" marginheight="0" marginwidth="0" name="probando"></iframe>

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