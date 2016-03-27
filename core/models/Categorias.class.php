<?php

  /**
   *Funciones basicas de la categoria
   */
  class Categorias
  {
    private $db;
    private $id;
    private $nombre;

    public function __construct()
    {
      $this->db = new Conexion();
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

      $sql = "DELETE FROM categorias WHERE categoriaid='$this->id';";
      $sql .= "DELETE FROM foros WHERE forocatid='$this->id';";

      $this->db->multi_query($sql);

      header('location: ?view=categorias');

    }

    private function Errors($link)
    {
      try {

        if (empty($_POST['nombre'])) {
          throw new Exception(1);
        }
        else {
          $this->nombre = $this->db->real_escape_string($_POST['nombre']);
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
