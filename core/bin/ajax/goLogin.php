<?php
  //variables enviadas desde login.js form en gologin()
  if (!empty($_POST['user']) and !empty($_POST['pass'])) {
    $db = new Conexion();

    $user = $db->real_escape_string($_POST['user']);
    $pass = Encrypt($_POST['pass']);

    $sql = $db->query("SELECT userid FROM users
                      WHERE (username='$user' OR useremail='$user')
                      AND userpass='$pass'");

    if ($db->rows($sql) > 0) {
      if ($_POST['sesion']) {
        #setea el tiempo que dura la sesion
        #60 milisegundos*60=360 (1hora) *24= 24 horas
        ini_set('session.cookie_lifetime',time()+(60*60*24));
        $_SESSION['session_id'] = $db->recorrer($sql)[0];
        //OnlineUsers()
        $_SESSION['time_online'] = time() - (60*6);
        //setea connect.response en login.js
        echo 1;
      }
    } else {
      echo '<div class="alert alert-dismissible alert-danger">
      <strong>Error</strong> Los datos ingresados son incorrectos.
      </div>';
     }
    $db->liberar($sql);
    $db->close();
    }
  else {
    echo '<div class="alert alert-dismissible alert-danger">
    <strong>Error</strong> Los campos estan vacios.
    </div>';
  }

 ?>
