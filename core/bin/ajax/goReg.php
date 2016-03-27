  <?php

  $db = new Conexion();

  $user = $db->real_escape_string($_POST['user']);
  $pass = Encrypt($_POST['pass']);
  $email = $db->real_escape_string($_POST['email']);

  $sql = $db->query("SELECT username
                     FROM users
                     WHERE username='$user' OR useremail='$email' LIMIT 1;
                     ");


  if($db->rows($sql) == 0) {
    $userkey = md5(time());
    $url = APP_URL . '?view=activar&key=' . $userkey;

    #Correo electronico
    $mail = new PHPMailer;
    $mail->CharSet = "UTF-8";
    $mail->Encoding = "quoted-printable";

    $mail->isSMTP();

    $mail->Host = MAIL_HOST;
    $mail->SMTPAuth = true;
    $mail->Username = MAIL_USER;
    $mail->Password = MAIL_PASS;
    $mail->SMTPSecure = 'ssl';
    $mail->Port = MAIL_PORT;

    $mail->setFrom(MAIL_USER, APP_TITLE);
    $mail->addAddress($email, $user);
    $mail->isHTML(true);

    $mail->Subject = 'Activación de tu cuenta';
    $mail->Body    = EmailTemplate($user,$url);
    $mail->AltBody = 'Estimado ' . $user . ' para activar su cuenta haga click en el siguiente enlace: ' . $url;

    if(!$mail->send()) {
        $alert = '<div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>Error:</strong> ' . $mail->ErrorInfo . ' </div>';
    } else {
      $db->query("INSERT INTO users (
                                    username,
                                    useremail,
                                    userpass,
                                    userkey)
                            VALUES ('$user',
                                    '$email',
                                    '$pass',
                                    '$userkey');
                                    ");

      $sql2 = $db->query("SELECT MAX(userid) AS userid
                          FROM users;");
      $_SESSION['session_id'] = $db->recorrer($sql2)[0];
      $db->liberar($sql2);
      $alert = 1;
    }
  } else {
    $usuario = $db->recorrer($sql)[0];

    if(strtolower($user) == strtolower($usuario)){
      $alert = '<div class="alert alert-dismissible alert-danger">
      <button type="button" class="close" data-dismiss="alert">x</button>
      <strong>Error:</strong> El usuario ya existe.
      </div>';
    } else {
      $alert = '<div class="alert alert-dismissible alert-danger">
      <button type="button" class="close" data-dismiss="alert">x</button>
      <strong>Error:</strong> El email ya existe.
      </div>';
    }
  }

  $db->liberar($sql);
  $db->close();

  echo $alert;
  ?>
