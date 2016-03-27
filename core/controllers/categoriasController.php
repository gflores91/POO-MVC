<?php

  if (isset($_SESSION['session_id'])
        and $_users[$_SESSION['session_id']]['permisos'] = 2) {

    require('core/models/Categorias.class.php');

    //almacena verdadero o falso
    $isset_id = isset($_GET['id']) and is_numeric($_GET['id']) and $_GET['id'] >= 1;
    $categorias = new Categorias();

    switch (isset($_GET['mode']) ?$_GET['mode'] : null) {
      case 'create':
        if ($_POST) {
          $categorias->Create();
        } else {
          include(HTML_DIR. 'categorias/create_categoria.php');
        }

        break;

      case 'edit':
        if ($isset_id and array_key_exists($_GET['id'],$_categorias)) {

          if ($_POST) {
            $categorias->Edit();
          } else {
            include(HTML_DIR. 'categorias/edit_categoria.php');
          }

        } else {
          header('location: ?view=categorias');
        }

        break;

      case 'delete':
        if ($isset_id) {
          $categorias->Delete();
        } else {
          header('location: ?view=categorias');
        }

        break;

      default:
        $db = new Conexion();
        $sql = $db->query("SELECT categoriaid, categorianombre
                            FROM categorias;");

        include(HTML_DIR. 'categorias/list_categoria.php');

        $db->liberar($sql);
        $db->close();
        break;
    }

  } else {
    header('location: ?view=index');
  }


 ?>
