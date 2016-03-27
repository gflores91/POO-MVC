<?php

  if (!isset($_SESSION['session_id']) and isset($_GET['key'])) {

    $db= new Conexion();
    $userlostpass = $db->real_escape_string($_GET['key']);

    $sql= $db->query("SELECT userid, usernewpass FROM users
                      WHERE userlostpass='$userlostpass' LIMIT 1;");

    if ($db->rows($sql) > 0) {
      $data = $db->recorrer($sql);
      $userid = $data[0];
      $usernewpass = Encrypt($data[1]);
      $pass = $data[1];

      $db->query("UPDATE users
                  SET userlostpass='',usernewpass='', userpass='$usernewpass'
                  WHERE userid='$userid';");

      include(HTML_DIR. 'lostpass_mensaje.php');
    } else {
      header('location: ?view=index');

    }

    $db->liberar($sql);
    $db->close();

  } else {
    header('location: ?view=index');
  }


 ?>
