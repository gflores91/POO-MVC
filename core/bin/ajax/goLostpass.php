<?php

    $db= new Conexion();

    $email= $db->real_escape_string($_POST['email']);

    $sql = $db->query("SELECT userid,username FROM users
                        WHERE useremail='$email' LIMIT 1;");

    if ($db->rows($sql) > 0) {
      $data = $db->recorrer($sql);

      $userid = $data[0];
      $username = $data[1];
      $userlostpass = md5(time());
      $usernewpass = strtoupper(substr(sha1(time()),0,8));

      $url = APP_URL .'?view=lostpass&key='. $userlostpass;

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

      $mail->Subject = 'Recuperar contraseña';
      $mail->Body    =  EmailLostpassTemplate($username,$url);
      $mail->AltBody = 'Estimado ' . $user . ' para cambiar contraseña haga click en el siguiente enlace: ' . $url;

      if(!$mail->send()) {
          $alert = '<div class="alert alert-dismissible alert-danger">
          <button type="button" class="close" data-dismiss="alert">x</button>
          <strong>Error:</strong> ' . $mail->ErrorInfo . ' </div>';
      } else {
        $db->query("UPDATE users
                    SET userlostpass='$userlostpass',usernewpass='$usernewpass'
                    WHERE userid = '$userid';");

        $alert = 1;
      }

    } else {
      $alert =
      '<div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>Error:</strong>Email incorrecto.</div>';
    }


    $db->liberar($sql);
    $db->close();

    echo $alert;

 ?>
