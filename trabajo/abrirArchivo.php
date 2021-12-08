<?php

 //Definición del nombre del archivo
 
 $archivo ="./Archivos/".$_POST['fichero'];


 //Verifi cando la existencia del archivo

 if (!file_exists($archivo)){

 	echo 'Archivo NO existe..!!';

 }else{

 //Abriendo en forma de lectura

 	$abrir = fopen($archivo, "r");

}



 //Obtener el contenido a partir de la lectura

 $contenido = fread($abrir, filesize($archivo));

 //Cerrando el archivo

 fclose($abrir);

 //Imprimir el contenido del archivo

 echo $contenido;



?>
            <br>
            <a href="index.php">Volver</a>