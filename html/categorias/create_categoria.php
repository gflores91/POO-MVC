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
						Aviso: la categoria ha sido creada correctamente.
					</div>
					</div>';
				}
				if (isset($_GET[error])) {
						echo
						'
						<div class="container">
						<div class="alert alert-danger" role="alert" align="center">
              Lo sentimos: la categoria no ha sido creada correctamente.
						</div>
						</div>';
					}

			 ?>



			<!-- Main -->
			<div id="main" class="container">

				<!--Links administrador-->
				<?php if (isset($_SESSION['session_id'])
							and $_users[$_SESSION['session_id']]['permisos'] = 2): ?>

						<div class="row">
						 <div class="pull-right">
							<div class="12u">
								<section>

									<div class="btn-group btn-group-lg">
										 <a href="?view=foros" class="btn btn-primary">
 											 Gestionar Foros
										 </a>
								 	 </div>

									 <div class="btn-group btn-group-lg">
											<a href="?view=categorias" class="btn btn-primary">
												Gestionar Categorias
											</a>
									 </div>

									</section>

							 </div>
						 </div>
						</div>

				<?php endif; ?>
				<!--/Links administrador-->



				<!--Categorias-->
				<div class="row">
					<div class="12u">
						<section>

							<div class="panel panel-primary">
							  <div class="panel-heading">
							    <h3 class="panel-title">Crear categoria</h3>
							  </div>
							  <div class="panel-body">


									<div class="row">
										<div class="8u">

                      <form class="form-horizontal" target="_self" action="?view=categorias&mode=create" method="POST" enctype="application/x-www-form-urlencoded">
                        <div class="form-group">
                          <label for="nombre" class="col-sm-2 control-label">Nombre</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" name="nombre" placeholder="Nombre Categoria">
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
