<?php

  function Users(){
      $db = new Conexion();
      $sql = $db->query("SELECT userid,
                                username,
                                userpass,
                                useremail,
                                userrol
                          FROM users");

      if ($db->rows($sql) >0) {
        while ($d = $db->recorrer($sql)) {
          $_users[$d['userid']]= array(
            'userid' => $d['userid'],
            'name' => $d['username'],
            'pass' => $d['userpass'],
            'email' => $d['useremail'],
            'permisos' => $d['userrol'],
          );
        }
      } else {
        $_users = false;
      }

      $db->liberar($sql);
      $db->close();

      return $_users;
  }

 ?>
