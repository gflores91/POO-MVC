<?php

  function OnlineUsers(){
    if (isset($_SESSION['session_id'])) {
      $userid = $_SESSION['session_id'];

      if (time() >= ($_SESSION['time_online'] + (60*5))) {
        $time = time();
        $_SESSION['time_online'] = $time;
        $_SESSION['users'][$userid]['uconexion'] = $time;

        $db = new Conexion();
        $db->query(" UPDATE users
                     SET useruconexion = '$time'
                     WHERE userid = '$userid'
                     LIMIT 1
                  ;");
        $db->close();
      }
    }
  }

 ?>
