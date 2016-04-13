<?php

  if (isset($_GET['id']) and array_key_exists($_GET['id'],$_users)) {
    $userid = intval($_GET['id']);

    $db = new Conexion();
    $sql = $db->query("SELECT COUNT(temaid) FROM temas
                       WHERE temauserid='$userid';");

    include(HTML_DIR. 'perfil/perfil.php');

    $db->liberar($sql);
    $db->close();

  } else {
    header('location: ?view=index');
  }

 ?>
