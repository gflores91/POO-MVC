<?php
if(isset($_GET['id']) and is_numeric($_GET['id']) and $_GET['id'] >= 1) {
  $foroid = intval($_GET['id']);

  if (array_key_exists($foroid,$_foros)) {
    $db = new Conexion();

    #tipo 1= tema normal; tipo 2= tema anclado(anuncio)
    $sql_anuncios= $db->query("SELECT temaid,
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
                      WHERE temaforoid='$foroid' AND tematipo='2'
                      ORDER BY temaid DESC;");

    $sql= $db->query("SELECT temaid,
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
                      WHERE temaforoid='$foroid' AND tematipo='1'
                      ORDER BY temaid DESC;");

    include(HTML_DIR.'temas/temas.php');

    $sql->liberar($sql_anuncios,$sql);
    $sql->close();
  } else {
    header('location: ../index.php?view=error');
  }

} else {
  header('location: ../index.php?view=index');
}
?>
