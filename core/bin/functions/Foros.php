<?php

  function Foros(){
    $db = new Conexion();
    $sql = $db->query("SELECT foroid,
                              foronombre,
                              forodesc,
                              forocmensajes,
                              foroctemas,
                              forocatid,
                              foroestado,
                              foroutema,
                              foroidutema
                        FROM foros;");

    if ($db->rows($sql) > 0) {
      while ($data = $db->recorrer($sql)) {
        $foros[$data['foroid']] = array(
          'id' => $data['foroid'],
          'nombre' => $data['foronombre'],
          'desc' => $data['forodesc'],
          'cmensajes' => $data['forocmensajes'],
          'ctemas' => $data['foroctemas'],
          'catid' => $data['forocatid'],
          'estado' => $data['foroestado'],
          'utema' => $data['foroutema'],
          'idutema' => $data['foroidutema']
         );
      }
    } else {
      $foros = false;
    }

    $db->liberar($sql);
    $db->close();

    return $foros;
  }


 ?>
