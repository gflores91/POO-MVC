<?php

  /**
   *Funciones basicas del tema
   */

    class Temas
    {
      private $db;
      private $id;
      private $titulo;
      private $contenido;
      private $foroid;
      private $userid;

      public function __construct()
      {
        $this->db = new Conexion();
        $this->id = isset($_GET['id']) ? intval($_GET['id']) : null;
        $this->foroid = intval($_GET['idforo']);
        $this->userid = isset($_SESSION['session_id']) ? $_SESSION['session_id'] : null;
      }

      public function Checktema(){
        $sql = $this->db->query("SELECT temaid,
                                        tematitulo,
                                        temacontenido,
                                        temaforoid,
                                        temauserid,
                                        temaestado,
                                        tematipo,
                                        temafecha,
                                        temavisitas,
                                        temarespuestas,
                                        temauid,
                                        temafultimo
                                  FROM temas
                                  WHERE temaid = 'this->id' LIMIT 1;");

        if ($this->db->rows($sql) > 0) {
          $tema = $this->db->recorrer($sql);
        } else {
          $tema = false;
        }

        $this->db->liberar($sql);

        return $tema;

      }

      public function Create()
      {
        $this->Errors('?view=dtema&mode=create&idforo='.$this->foroid.'&error=');

        $fecha = date('d/m/Y h:i a', time());

        $this->db->query("INSERT INTO temas(
                                                tematitulo,
                                                temacontenido,
                                                temaforoid,
                                                temauserid,
                                                temafecha,
                                                temauid,
                                                temafultimo
                                                )
                                          VALUES(
                                                '$this->titulo',
                                                '$this->contenido',
                                                '$this->foroid',
                                                '$this->userid',
                                                '$fecha',
                                                '$this->userid',
                                                '$fecha'
                                                );
                          ");

        $uid = $this->db->insert_id;

        $this->db->query("UPDATE foros
                          SET foroctemas=foroctemas + '1',
                          forocmensajes = forocmensajes + '1'
                          WHERE foroid = '$this->foroid'
                          ;"
                        );

        header('location: dtema/' .Url($uid,$this->titulo,$this->foroid));



      }

      public function Edit()
      {

        $this->id = intval($_GET['id']);
        $this->Errors('?view=dtema&mode=edit&id='.$this->id.'&error=');

        $this->db->query("UPDATE temas
                          SET temanombre='$this->nombre'
                          WHERE temaid='$this->id';
                          ");

        header('location: ?view=dtema&mode=edit&id='.$this->id.'&success=true');

      }

      public function Delete()
      {
        $this->id = intval($_GET['id']);

        $sql = "DELETE FROM temas WHERE temaid='$this->id';";
        $sql .= "DELETE FROM foros WHERE forocatid='$this->id';";

        $this->db->multi_query($sql);

        header('location: ?view=temas');

      }

      public function Close(){

      }

      public function Anuncio(){

      }

      private function Errors($link)
      {
        try {

          if (empty($_POST['titulo']) or empty($_POST['contenido'])) {
            throw new Exception(1);
          }
          else {
            $this->titulo = $this->db->real_escape_string($_POST['titulo']);
            $this->contenido = $this->db->real_escape_string($_POST['contenido']);
          }

          if (strlen($this->titulo) < 9) {
            throw new Exception(2);
          }

          if (strlen($this->contenido) < 270) {
            throw new Exception(3);
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
