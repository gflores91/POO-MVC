<!-- Header -->
  <div id="header">
    <div class="container">

      <!-- Logo -->
        <div id="logo">
          <h1><a href="?view=index"><?php echo APP_TITLE; ?></a></h1>
        </div>

      <!-- Nav -->
      <nav id="nav">
        <ul>
          <li class="active"></i><a href="?view=index">Inicio</a></li>

              <?php
                if (!isset($_SESSION['session_id'])) {
                  echo
                  '
                  <li><a href="#Loginmodal" data-toggle="modal">
                        Login</a></li>

                  <li><a href="#Regmodal" data-toggle="modal">
                        Registrar</a></li>
                  ';
                } else {
                  echo
                  '
                  <li><a href="?view=perfil&id='.$_SESSION['session_id'].'">'.
                        strtoupper($_users[$_SESSION['session_id']]['name']).'
                        </a></li>

                  <li><a href="?view=cuenta">
                        CUENTA</a></li>

                  <li><a href="?view=logout" target="_self">
                        Cerrar Sesion</a></li>
                  ';
                }
               ?>

        </ul>
      </nav>

    </div>
  </div>
<!-- Header -->

  <?php
  if (!isset($_SESSION['session_id'])) {
    include(HTML_DIR.'public/login.html');
    include(HTML_DIR.'public/reg.html');
    include(HTML_DIR.'public/lostpass.html');
  }
  ?>
