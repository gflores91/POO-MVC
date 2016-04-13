<?php include(HTML_DIR.'layouts/header.php'); ?>
	<body class="homepage">

<?php include(HTML_DIR.'layouts/topnav.php'); ?>



	<!-- Main -->
		<div id="page">
			<?php

				if (isset($_GET[error])) {

					if ($_GET[error] == 1) {
						echo
						'
						<div class="container">
						<div class="alert alert-danger" role="alert" align="center">
              Lo sentimos: Los campos estan vacios.
						</div>
						</div>';

					}elseif ($_GET[error] == 2) {
            echo
						'
						<div class="container">
						<div class="alert alert-danger" role="alert" align="center">
							Lo sentimos: El titulo debe ser mayor a 9 caracteres.
						</div>
						</div>';
					}
          elseif ($_GET[error] == 3) {
            echo
						'
						<div class="container">
						<div class="alert alert-danger" role="alert" align="center">
							Lo sentimos: El contenido debe ser mayor a 270 caracteres.
						</div>
						</div>';
					}
          else {
						echo
						'
						<div class="container">
						<div class="alert alert-danger" role="alert" align="center">
							Lo sentimos: El foro no ha sido creada correctamente.
						</div>
						</div>';
					}

					}

			 ?>



			<!-- Main -->
			<div id="main" class="container">

        <!--Links de navegacion-->
        <div class="row">
          <div class="12u">

              <ul class="breadcrumb">
                <li class="active"> <i class="fa fa-comment"></i> <a href="?view=dtema&mode=create&idforo=<?php echo $foroid; ?>">Temas</a></li>
              </ul>

          </div>
        </div>
        <!--./Links de navegacion-->



				<!--Categorias-->
				<div class="row">
					<div class="12u">
						<section>

							<div class="panel panel-primary">
							  <div class="panel-heading">
							    <h3 class="panel-title">Crear Tema</h3>
							  </div>
							  <div class="panel-body">


									<div class="row">
										<div class="8u">

                      <form class="form-horizontal" action="?view=dtema&mode=create&idforo=<?php  echo $foroid; ?>" method="POST" enctype="application/x-www-form-urlencoded">
												<div class="form-group">
													<label for="titulo" class="col-sm-2 control-label">Titulo</label>
													<div class="col-sm-10">
														<input type="text" class="form-control" name="titulo" maxlength="250" placeholder="Titulo Tema">
													</div>
												</div>

												<div class="form-group">
                          <label for="contenido" class="col-sm-2 control-label">Contenido</label>
                          <div class="col-sm-10">
														<textarea name="contenido" class="form-control" rows="6" placeholder="Contenido del tema"></textarea>
													</div>
                        </div>


												<div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10">
                            <button type="reset" class="btn btn-warning">Resetear</button>
                            <button type="submit" class="btn btn-success">Crear</button>
                          </div>
                        </div>
                    </form>
										</div>
									</div>



							  </div>
							</div>

						</section>
					</div>
				</div>
				<!--./Categorias-->

			</div>
			<!-- Main -->

		</div>
	<!-- /Main -->

<?php include(HTML_DIR.'layouts/footer.php'); ?>
	</body>
</html>
