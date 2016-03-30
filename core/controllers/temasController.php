<?php
if(isset($_GET['id']) and is_numeric($_GET['id']) and $_GET['id'] >= 1) {
  echo 'Se debe construir el detalle del foro';
} else {
  header('location: ../index.php?view=index');
}
?>
