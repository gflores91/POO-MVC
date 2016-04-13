  <?php

  $db = new Conexion();

  $user = $db->real_escape_string($_POST['user']);
  $pass = Encrypt($_POST['pass']);
  $email = $db->real_escape_string($_POST['email']);

  $sql = $db->query("SELECT username
                     FROM users
                     WHERE username='$user' OR useremail='$email' LIMIT 1;
                     ");

  $sql_limite = $db->query("SELECT userid FROM users;");

  if ($db->rows($sql_limite) < 3) {
    if($db->rows($sql) == 0) {
      $userkey = md5(time());
      $url = APP_URL . '?view=activar&key=' . $userkey;

      //llama a la funcion para enviar email (functions/SendEmail.php)
      $alert= SendEmail($user,$email,$pass,$userkey,$url);

    } else {
      $usuario = $db->recorrer($sql)[0];

      if(strtolower($user) == strtolower($usuario)){
        $alert = '<div class="alert alert-dismissible alert-danger">
        <strong>Error:</strong> El usuario ya existe.
        </div>';
      } else {
        $alert = '<div class="alert alert-dismissible alert-danger">
        <strong>Error:</strong> El email ya existe.
        </div>';
      }
    }

  } else {
    $alert = '<div class="alert alert-dismissible alert-danger">
    <strong>Error:</strong> Limite de usuarios alcanzado.
    </div>';
  }

  $db->liberar($sql,$sql_limite);
  $db->close();

  echo $alert;
  ?>
