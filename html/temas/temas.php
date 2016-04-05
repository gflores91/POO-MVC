<?php include(HTML_DIR.'layouts/header.php'); ?>
	<body class="homepage">

<?php include(HTML_DIR.'layouts/topnav.php'); ?>



	<!-- Main -->
		<div id="page">
			<?php

				if (isset($_GET[success])) {
					echo
					'
					<div class="container">
					<div class="alert alert-success" role="alert" align="center">
						Bienvenido, su usuario ha sido activado correctamente
					</div>
					</div>';
				}
				if (isset($_GET[error])) {
						echo
						'
						<div class="container">
						<div class="alert alert-danger" role="alert" align="center">
							Lo sentimos, su usuario no ha sido activado correctamente
						</div>
						</div>';
					}

			 ?>



			<!-- Main -->
			<div id="main" class="container">

						<!--Links de navegacion-->
						<div class="row">
							<div class="12u">

                  <ul class="breadcrumb">
                    <li><a href="?view=index">Inicio</a></li>
                    <li class="active"><a href="temas/<?php echo Url($_GET['id'],$_foros[$_GET['id']]['nombre']); ?>"><?php echo $_foros[$foroid]['nombre']; ?></a></li>
                  </ul>

							</div>
						</div>
						<!--./Links de navegacion-->

            <!--Links usuario-->
						<?php
							$nuevotema=
							'
							<div class="row">
	             <div class="pull-right">
	              <div class="12u">
	                <section>

	                  <div class="btn-group btn-group-lg">
	                     <a href="?view=dtema&mode=create&idforo='.$foroid.'" class="btn btn-primary">
	                       Nuevo tema
	                     </a>
	                   </div>

	                  </section>

	               </div>
	             </div>
	            </div>
							';
							#Permisos 0=usuario normal; 1= moderador; 2= Administrador
							if (isset($_SESSION['session_id']) and
							 ($_foros[$foroid]['estado'] == 1 or $_users[$_SESSION['session_id']]['permisos'] == 2)) {
								echo $nuevotema;
							}
						 ?>


            <!--/Links usuario-->

            <!--Temas-->
            <div class="row">
              <div class="12u">
                <section>
                  <!--Avisos-->
                  <div class="panel panel-primary">
                    <div class="panel-heading">
                      <h3 class="panel-title">Anuncios</h3>
                    </div>
                    <div class="panel-body">

                      <?php if ($db->rows($sql_anuncios) > 0):
                          while ($anuncio = $db->recorrer($sql_anuncios)) {

                        ?>

                        <div class="row">
                          <div class="1u">
                            <!--0= no leido; 1= leido-->
                            <?php if ($anuncio['temaestado'] == 0): ?>
                              <i class="fa fa-eye fa-2x"></i>
                            <?php else: ?>
                              <i class="fa fa-eye-slash fa-2x"></i>

                            <?php endif; ?>
                          </div>
                          <div class="7u">
                            <a href="dtema/<?php echo Url($anuncio['temaid'],$anuncio['tematitulo'],$foroid); ?>"><?php echo $anuncio['tematitulo']; ?></a>
                          </div>
                          <div class="2u">

                            <?php #transforma a numero (item,cantidad decimales,separador decimal, separador miles)
														 echo number_format($anuncio['temavisitas'],0,',','.'); ?> Visitas<br>
                            <?php echo number_format($anuncio['temarespuestas'],0,',','.'); ?> Temas
                          </div>
                          <div class="2u">
                            Por: <a href="#"> <?php  echo $_users[$anuncio['temauid']]['name'];?></a><br>
                            <?php  echo $anuncio[temafultimo];?>
                          </div>
                        </div>

                        <?php } ?>

                      <?php else: ?>

                        <div class="row">
                          <div class="12u">
                            <div class="alert alert-info" role="alert">
                              <strong>Lo sentimos</strong> Aun no se han creado anuncios.
                            </div>
                          </div>
                        </div>

                      <?php endif; ?>

                    </div>
                  </div>
                  <!--Avisos-->

                  <!--Temas usuario-->
                  <div class="panel panel-primary">
                    <div class="panel-heading">
                      <h3 class="panel-title">Temas</h3>
                    </div>
                    <div class="panel-body">

                      <?php if ($db->rows($sql) > 0):
                          while ($tema = $db->recorrer($sql)) {
                        ?>

                        <div class="row">
                          <div class="1u">
                            <?php #0= no leido; 1= leido
														if ($tema['temaestado'] == 0): ?>
                              <i class="fa fa-eye fa-2x"></i>
                            <?php else: ?>
                              <i class="fa fa-eye-slash fa-2x"></i>

                            <?php endif; ?>
                          </div>
                          <div class="7u">
                            <a href="dtema/<?php echo Url($tema['temaid'],$tema['tematitulo'],$foroid); ?>"><?php echo $tema['tematitulo']; ?></a>
                          </div>
                          <div class="2u">
                            <!--transforma a numero (item,cantidad decimales,separador decimal, separador miles)-->
                            <?php echo number_format($tema['temavisitas'],0,',','.'); ?> Visitas<br>
                            <?php echo number_format($tema['temarespuestas'],0,',','.'); ?> Temas
                          </div>
                          <div class="2u">
                            Por: <a href="#"> <?php  echo $_users[$tema['temauid']]['name'];?></a><br>
                            <?php  echo $tema[temafultimo];?>
                          </div>
                        </div>

                        <?php } ?>

                      <?php else: ?>

                        <div class="row">
                          <div class="12u">
                            <div class="alert alert-info" role="alert">
                              <strong>Lo sentimos</strong> Aun no se han creado temas.
                            </div>
                          </div>
                        </div>

                      <?php endif; ?>

                    </div>
                  </div>
                      <!--/Temas usuario-->

                    </div>
                  </div>

                </section>
              </div>
            </div>
            <!--./Temas-->

			</div>
			<!-- Main -->

		</div>
	<!-- /Main -->

<?php include(HTML_DIR.'layouts/footer.php'); ?>
	</body>
</html>
