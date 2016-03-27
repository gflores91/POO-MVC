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
				<?php for ($x=1; $x < 4; $x++) {  ?>
				<div class="row">
					<div class="12u">
						<section>

							<div class="panel panel-primary">
							  <div class="panel-heading">
							    <h3 class="panel-title">Titulo categoria</h3>
							  </div>
							  <div class="panel-body">

									<?php for ($i=1; $i < 5; $i++) {		?>

									<div class="row">
										<div class="8u">
											Titulo Foro
										</div>

										<div class="2u">
											XX Temas <br />
											XX Mensajes
										</div>

										<div class="2u">
											Ultimo mensaje
										</div>
									</div>

									<?php }  ?>


							  </div>
							</div>

						</section>
					</div>
				</div>
				<?php } ?>
				<!--./Categorias-->

			</div>
			<!-- Main -->

		</div>
	<!-- /Main -->

<?php include(HTML_DIR.'layouts/footer.php'); ?>
	</body>
</html>
