<?php

  function EmailLostpassTemplate($user,$url){
    $template=
    '
    <!DOCTYPE html>
    <html>
      <head>
        <meta charset="utf-8">
        <title></title>
      </head>
      <body>
        <h2>Estimado ' .$user. '</h2>
        <p>
          Para confirmar el cambio de contraseña solo debe dirigirse al siguiente enlace:
           <a href="'.$url.'" target="_blank">click aquí</a>
        </p>

        <p>
          Gracias por su preferencia
        </p>
      </body>
    </html>
    ';

    return $template;


  }

 ?>
