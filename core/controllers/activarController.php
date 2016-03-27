<?php

  if (isset($_GET['key'],$_SESSION['session_id'])) {
    $db = new Conexion();

    $userid = $_SESSION['session_id'];
    $userkey = $db->real_escape_string($_GET['key']);

    $sql = $db->query("SELECT userid FROM users
                      WHERE userid='$userid' AND userkey='$userkey' LIMIT 1;");

    if ($db->rows($sql) > 0) {
      $db->query("UPDATE users
                  SET useractive='1', userkey=' '
                  WHERE userid='$userid';");
      header('location: ?view=index&success=true');
    } else {
      header('location: ?view=index&error=true');

    }


    $db->liberar($sql);
    $db->close();

  } else {
    include(HTML_DIR.'public/logear.php');
  }


 ?>
