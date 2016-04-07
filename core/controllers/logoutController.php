<?php

  unset($_SESSION['session_id'],$_SESSION['cantidad_users'],$_SESSION['users']);
  header('location: ?view=index');

 ?>
