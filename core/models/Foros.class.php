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
    private $catid;
    private $estado;

    private $seguridad;

    public function __construct()
    {
      $this->db = new Conexion();
      $this->seguridad = new Seguridad();
    }

    public function Create()
    {

      $this->Errors('?view=foros&mode=create&error=',true);

      $this->db->query("INSERT INTO foros(
                                              foronombre,
                                              forodesc,
                                              forocatid,
                                              foroestado
                                              )
                                        VALUES(
                                              '$this->nombre',
                                              '$this->desc',
                                              '$this->catid',
                                              '$this->estado'
                                              );
                        ");

      header('location: ?view=foros&mode=create&success=true');



    }

    public function Edit()
    {

      $this->id = intval($_GET['id']);
      $this->Errors('?view=foros&mode=edit&id='.$this->id.'&error=',false);

      $this->db->query("UPDATE foros
                        SET foronombre='$this->nombre',
                            forodesc='$this->desc',
                            forocatid='$this->catid',
                            foroestado='$this->estado'

                        WHERE foroid='$this->id';
                        ");

      header('location: ?view=foros&mode=edit&id='.$this->id.'&success=true');

    }

    public function Delete()
    {
      $this->id = intval($_GET['id']);

      $mquery = "DELETE FROM foros WHERE foroid='$this->id';";
      $mquery .= "DELETE FROM temas WHERE temaforoid='$this->id';";

      $this->db->multi_query($mquery);

      header('location: ?view=foros');

    }

    private function Errors($link)
    {
      //esta funcion es privada por eso se agrega esta linea
      global $_categorias;

      try {

        if (empty($_POST['nombre']) or empty($_POST['desc'])
        or !isset($_POST['estado']) ) {
          throw new Exception(1);
        }else {
          $this->nombre = $this->seguridad->XSS(
                          $this->db->real_escape_string($_POST['nombre'])
                          );
                          
          $this->desc = $this->seguridad->XSS(
                          $this->db->real_escape_string($_POST['desc'])
                          );

          if ($_POST['estado'] == 1) {
            $this->estado = 1;
          }else {
            $this->estado = 0;
          }

        }
        if (!array_key_exists($_POST['catid'],$_categorias)) {
          throw new Exception(2);
        }else {
          $this->catid = intval($_POST['catid']);
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
