<?php include(HTML_DIR.'layouts/header.php'); ?>
	<body class="homepage">

<?php include(HTML_DIR.'layouts/topnav.php'); ?>



	<!-- Main -->
		<div id="page">

			<!-- Main -->
			<div id="main" class="container">

				<!--Links administrador-->
				<?php if (isset($_SESSION['session_id']) and $_SESSION['session_id'] == $_GET['id'] ): ?>

						<div class="row">
						 <div class="pull-right">
							<div class="12u">
								<section>

									<div class="btn-group btn-group-lg">
										 <a href="?view=categorias" class="btn btn-primary">
											 <i class="fa fa-edit"></i>Editar perfil
										 </a>
									</div>

							 </div>
						 </div>
						</div>

				<?php endif; ?>
				<!--/Links administrador-->



				<!--Perfil-->
				<div class="row">
					<div class="12u">
						<section>

							<div class="panel panel-primary">
							  <div class="panel-heading">
							    <h3 class="panel-title">Perfil de <?php echo $_users[$userid]['name']; ?></h3>
							  </div>
							  <div class="panel-body">

									<div class="row">
										<div class="2u">
                      <center>
                        <img src="content/app/images/users/<?php echo $_users[$userid]['image']; ?>"
                         class="thumbnail" height="120">
                        <strong><?php echo $_users[$userid]['name']; ?></strong> <?php echo GetUserStatus($_users[$userid]['uconexion']); ?> <br>
                        <b><?php echo $_users[$userid]['tipo']; ?></b> <br>
                        <?php echo $db->recorrer($sql)[0] ?> temas <br>
                        {{mensajes}} mensajes <br>
                        <?php echo $_users[$userid]['edad']; ?> años <br>
                        Registrado: <?php echo $_users[$userid]['fregistro']; ?>
                      </center>

										</div>

                    <div class="10u">
                      <blockquote>
                        <?php echo $_users[$userid]['biografia']; ?>
                      </blockquote>
                      <hr>
                      <p>
                        <?php echo BBCode($_users[$userid]['firma']); ?>
                      </p>
										</div>
									</div>

							  </div>
							</div>

						</section>
					</div>
				</div>
				<!--./Perfil-->

			</div>
			<!-- Main -->

		</div>
	<!-- /Main -->

<?php include(HTML_DIR.'layouts/footer.php'); ?>
	</body>
</html>
