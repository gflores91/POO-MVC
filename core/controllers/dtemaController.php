<?php

    $mode = isset($_GET['mode']) ? $_GET['mode'] : null;

    if (isset($_GET['idforo']) and array_key_exists($_GET['idforo'],$_foros)) {
      require('core/models/Temas.class.php');

      $foroid = intval($_GET['idforo']);

      //almacena verdadero o falso
      $isset_id = isset($_GET['id']) and is_numeric($_GET['id']) and $_GET['id'] >= 1;
      $temas = new Temas();

      $logged = isset($_SESSION['session_id']);

      if ($logged) {
        $cerrado = $_foros[$foroid]['estado'] == 1 or $_users[$_SESSION['session_id']]['permisos'] == 2;
      } else {
        $cerrado = false;
      }


      switch ($mode) {

        case 'create':

          if ($logged and $cerrado) {
            if ($_POST) {
              $temas->Create();
            } else {
              include(HTML_DIR. 'temas/create_tema.php');
            }
          }

          break;

        case 'edit':
          if ($isset_id and $logged) {

            if ($_POST) {
              $temas->Edit();
            } else {
              include(HTML_DIR. 'temas/edit_tema.php');
            }

          } else {
            header('location: ?view=temas');
          }

          break;

        case 'delete':
          if ($isset_id and $logged) {
            $temas->Delete();
          } else {
            header('location: ?view=temas');
          }

          break;

        case 'close':
          if ($isset_id and $logged) {
            $temas->Close();
          } else {
            header('location: index.php?view=index');
          }

          break;

        case 'anuncio':

          if ($isset_id and $logged) {
            $temas->Anuncio();
          } else {
            header('location: index.php?view=index');
          }

          break;

        default:

          if ($isset_id and $logged) {

            $tema = $temas->Ckecktema();

            if (false != $tema) {

            } else {
              header('location: index.php?view=index');
            }

          } else {

            header('location: index.php?view=index');
          }

          break;
      }

    } else {

      if (null == $mode) {
        header('location: ../index.php?view=index');
      } else {
        header('location: index.php?view=index');
      }

    }

 ?>
