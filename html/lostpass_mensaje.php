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

				<div class="row">
					<div class="12u">
						<section>

              <div class="alert alert-success" role="alert" align="center">
                Estimado usuario se ha generado su nueva contraseña
								<?php echo $pass; ?>,
								 por favor
								 <a href="#Loginmodal" data-toggle="modal">
											 inicie sesion.</a></li>
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
