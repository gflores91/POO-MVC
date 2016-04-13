<?php

  function SendEmail($user,$email,$pass,$userkey,$url){
    #Correo electronico
    $db = new Conexion();

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
        <strong>Error:</strong> ' . $mail->ErrorInfo . ' </div>';
    } else {
      $userfregistro = date('d/m/Y', time());
      $db->query("INSERT INTO users (
                                    username,
                                    useremail,
                                    userpass,
                                    userkey,
                                    userfregistro)
                            VALUES ('$user',
                                    '$email',
                                    '$pass',
                                    '$userkey',
                                    '$userfregistro');
                                    ");

      $sql2 = $db->query("SELECT MAX(userid) AS userid
                          FROM users;");
      $_SESSION['session_id'] = $db->recorrer($sql2)[0];
      $db->liberar($sql2);
      $alert = 1;
  }

    return $alert;

  }

 ?>
