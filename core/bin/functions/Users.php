<?php

  function Users(){
      $db = new Conexion();

      $query = $db->query("SELECT configuraciontimer
                           FROM configuracion
                           WHERE configuracionid='1'
                           LIMIT 1;");

      $timer = $db->recorrer($query)[0];
      $db->liberar($query);

      $sql = $db->query("SELECT userid,
                                username,
                                userpass,
                                useremail,
                                userrol,
                                useractive,
                                userkey,
                                userlostpass,
                                usernewpass,
                                useruconexion,
                                usernleidos,
                                userimage,
                                userfirma,
                                usertipo,
                                useredad,
                                userfregistro,
                                userbiografia
                          FROM users;");
      $users_actuales = $db->rows($sql);

      if (!isset($_SESSION['cantidad_users'])) {
        $_SESSION['cantidad_users'] = $users_actuales;
      }

      if ($_SESSION['cantidad_users'] != $users_actuales
          or (time() -60) <= $timer ) {
        while ($d = $db->recorrer($sql)) {
          //Esto puede resumirse en $_users[$d['userid']]= $d;
          //pero lo tengo con nombres personalizados
          $_users[$d['userid']]= array(
            'userid' => $d['userid'],
            'name' => $d['username'],
            'pass' => $d['userpass'],
            'email' => $d['useremail'],
            'activo' => $d['useractive'],
            'permisos' => $d['userrol'],
            'uconexion' => $d['useruconexion'],
            'nleidos' => $d['usernleidos'],
            'image' => $d['userimage'],
            'firma' => $d['userfirma'],
            'tipo' => $d['usertipo'],
            'edad' => $d['useredad'],
            'fregistro' => $d['userfregistro'],
            'biografia' => $d['userbiografia']

          );
        }
      } else {
        if (!isset($_SESSION['users'])) {
          while ($d = $db->recorrer($sql)) {
            $_users[$d['userid']]= array(
              'userid' => $d['userid'],
              'name' => $d['username'],
              'pass' => $d['userpass'],
              'email' => $d['useremail'],
              'activo' => $d['useractive'],
              'permisos' => $d['userrol'],
              'uconexion' => $d['useruconexion'],
              'nleidos' => $d['usernleidos'],
              'image' => $d['userimage'],
              'firma' => $d['userfirma'],
              'tipo' => $d['usertipo'],
              'edad' => $d['useredad'],
              'fregistro' => $d['userfregistro'],
              'biografia' => $d['userbiografia']
            );
          }
        } else {
          $_users = $_SESSION['users'];
        }
      }

      $_SESSION['users'] = $_users;

      $db->liberar($sql);
      $db->close();

      return $_SESSION['users'];
  }

 ?>
