<?php

  if (isset($_SESSION['session_id'])
        and $_users[$_SESSION['session_id']]['permisos'] == 2) {

    require('core/models/Foros.class.php');

    //almacena verdadero o falso
    $isset_id = isset($_GET['id']) and is_numeric($_GET['id']) and $_GET['id'] >= 1;
    $foros = new Foros();

    switch (isset($_GET['mode']) ? $_GET['mode'] : null) {
      case 'create':
        if ($_POST) {
          $foros->Create();
        } else {
          include(HTML_DIR. 'foros/create_foro.php');
        }

        break;

      case 'edit':
        if ($isset_id and array_key_exists($_GET['id'],$_foros)) {

          if ($_POST) {
            $foros->Edit();
          } else {
            include(HTML_DIR. 'foros/edit_foro.php');
          }

        } else {
          header('location: ?view=foros');
        }

        break;

      case 'delete':
        if ($isset_id) {
          $foros->Delete();
        } else {
          header('location: ?view=foros');
        }

        break;

      default:

        include(HTML_DIR. 'foros/list_foro.php');

        break;
    }

  } else {
    header('location: ?view=index');
  }


 ?>
