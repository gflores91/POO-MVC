<?php

  #Librerias requeridas
  require('core/core.php');

  #Determina el tiempo que el usuario lleva online
  OnlineUsers();

  #Redirigir a controlador
  if (isset($_GET['view'])) {
    if (file_exists('core/controllers/'.strtolower($_GET['view']).'Controller.php')) {
      include('core/controllers/'.strtolower($_GET['view']).'Controller.php');
    } else {
      include('core/controllers//errorController.php');
    }
  } else {
    include('core/controllers//indexController.php');
  }

 ?>
