<?php

  function Categorias(){
    $db = new Conexion();
    $sql = $db->query("SELECT * FROM categorias;");

    if ($db->rows($sql) > 0) {
      while ($data = $db->recorrer($sql)) {
        $categorias[$data['categoriaid']] = array(
          'id' => $data['categoriaid'],
          'nombre' => $data['categorianombre']
         );
      }
    } else {
      $categorias = false;
    }

    $db->liberar($sql);
    $db->close();

    return $categorias;
  }


 ?>
