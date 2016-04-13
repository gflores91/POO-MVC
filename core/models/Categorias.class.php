<?php

  /**
   *Funciones basicas de la categoria
   */
  class Categorias
  {
    private $db;
    private $id;
    private $nombre;

    private $seguridad;

    public function __construct()
    {
      $this->db = new Conexion();
      $this->seguridad = new Seguridad();
    }

    public function Create()
    {

      $this->Errors('?view=categorias&mode=create&error=');

      $this->db->query("INSERT INTO categorias(
                                              categorianombre
                                              )
                                        VALUES(
                                              '$this->nombre'
                                              );
                        ");

      header('location: ?view=categorias&mode=create&success=true');



    }

    public function Edit()
    {

      $this->id = intval($_GET['id']);
      $this->Errors('?view=categorias&mode=edit&id='.$this->id.'&error=');

      $this->db->query("UPDATE categorias
                        SET categorianombre='$this->nombre'
                        WHERE categoriaid='$this->id';
                        ");

      header('location: ?view=categorias&mode=edit&id='.$this->id.'&success=true');

    }

    public function Delete()
    {
      $this->id = intval($_GET['id']);

      $mquery = "DELETE FROM categorias WHERE categoriaid='$this->id';";
      $mquery .= "DELETE FROM foros WHERE forocatid='$this->id';";

      $sql = $this->db->query("SELECT foroid FROM foros
                               WHERE forocatid= '$this->id';");

      if ($this->db->rows($sql) > 0) {
        while ($d = $this->db->recorrer($sql)) {
          $foroid = $d[0];
          $mquery .= "DELETE FROM temas WHERE temaforoid = '$foroid';";
        }
      }
      $this->db->liberar($sql);
      $this->db->multi_query($mquery);

      header('location: ?view=categorias');

    }

    private function Errors($link)
    {
      try {

        if (empty($_POST['nombre'])) {
          throw new Exception(1);
        }
        else {
          $this->nombre = $this->seguridad->XSS(
                          $this->db->real_escape_string($_POST['nombre'])
                          );
        }

      } catch (Exception $error) {
        header('location: ' .$link.$error->getMessage());
        exit;
      }

    }

    public function __destuct()
    {
      $this->db->close();
    }

  }


 ?>
