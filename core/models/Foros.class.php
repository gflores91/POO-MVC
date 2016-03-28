<?php

  /**
   *Funciones basicas del foro
   */
  class Foros
  {
    private $db;
    private $id;
    private $nombre;
    private $desc;
    private $cmensajes;
    private $ctemas;
    private $catid;
    private $estado;


    public function __construct()
    {
      $this->db = new Conexion();
    }

    public function Create()
    {

      $this->Errors('?view=foros&mode=create&error=');

      $this->db->query("INSERT INTO foros(
                                              foronombre,
                                              forodesc,
                                              forocmensajes,
                                              foroctemas,
                                              forocatid,
                                              foroestado
                                              )
                                        VALUES(
                                              '$this->nombre',
                                              '$this->desc',
                                              '$this->cmensajes',
                                              '$this->ctemas',
                                              '$this->catid',
                                              '$this->estado'
                                              );
                        ");

      header('location: ?view=foros&mode=create&success=true');



    }

    public function Edit()
    {

      $this->id = intval($_GET['id']);
      $this->Errors('?view=foros&mode=edit&id='.$this->id.'&error=');

      $this->db->query("UPDATE foros
                        SET foronombre='$this->nombre'
                        WHERE foroid='$this->id';
                        ");

      header('location: ?view=foros&mode=edit&id='.$this->id.'&success=true');

    }

    public function Delete()
    {
      $this->id = intval($_GET['id']);

      $sql = "DELETE FROM foros WHERE foroid='$this->id';";
      $sql .= "DELETE FROM foros WHERE forocatid='$this->id';";

      $this->db->multi_query($sql);

      header('location: ?view=foros');

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
