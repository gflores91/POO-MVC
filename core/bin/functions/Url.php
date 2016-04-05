<?php

#Funcion que transforma las Urls a unas mas amigables
#esto utiliza las reglas impuestas en htaccess
#resultado = link/0-nombre-del-link

  function Url($id,$title,$foroid = null){

    if (null == $foroid) {
      $title = $id . '-'. $title;
    } else {
      $title = $id .'-'. $foroid .'-'. $title;
    }

    $title = trim($title);

     $title = str_replace(
         array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
         'a',
         $title
     );

     $title = str_replace(
         array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
         'e',
         $title
     );

     $title = str_replace(
         array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
         'i',
         $title
     );

     $title = str_replace(
         array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
         'o',
         $title
     );

     $title = str_replace(
         array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
         'u',
         $title
     );

     $title = str_replace(
         array('ñ', 'Ñ', 'ç', 'Ç'),
         array('n', 'N', 'c', 'C',),
         $title
     );

     //Esta parte se encarga de eliminar cualquier caracter extraño
     $title = str_replace(
         array("\\", "¨", "º", "-", "~",
              "#", "@", "|", "!", "\"",
              "·", "$", "%", "&", "/",
              "(", ")", "?", "'", "¡",
              "¿", "[", "^", "<code>", "]",
              "+", "}", "{", "¨", "´",
              ">", "<", ";", ",", ":",
              ".", " "),
          '-',
         $title
     );

     return $title;
   }


 ?>
