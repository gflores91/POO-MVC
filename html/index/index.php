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
								<li class="active"><a href="?view=index">Inicio</a></li>
							</ul>

					</div>
				</div>
				<!--./Links de navegacion-->

				<!--Links administrador-->

				<?php if (isset($_SESSION['session_id'])
							and $_users[$_SESSION['session_id']]['permisos'] == 2):
							#Permisos 0=usuario normal; 1= moderador; 2= Administrador
				 ?>

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


				<?php

					if (false!=$_categorias) {
						#Sentencia sql preparada
							$sql = $db->prepare("SELECT foroid FROM foros
																	WHERE forocatid=?;");
							$sql->bind_param('i',$idcategoria);
						?>
						<!--Categorias-->
						<div class="row">
							<div class="12u">
								<section>

									<?php foreach ($_categorias as $categoriaid => $ccontent){
											$idcategoria = $categoriaid;
											$sql->execute();
											#Almacena el resultado de sql preparado
											$sql->store_result();
										 ?>
										 <div class="panel panel-primary">
											 <div class="panel-heading">
												 <h3 class="panel-title"><?php echo $_categorias[$idcategoria]['nombre']; ?></h3>
											 </div>
											 <div class="panel-body">

											<!--verifica si hay resultados-->
										 <?php if ($sql->num_rows > 0):
											 $sql->bind_result($idforo);
											 ?>
											 <!--Foros-->
											 <?php while ($sql->fetch()) { ?>
											 <div class="row">
												 <div class="1u">
													 <?php if ($_foros[$idforo]['estado'] == 1): ?>
														 <i class="fa fa-th-list fa-2x"></i>
														 <?php else: ?>
															 <i class="fa fa-lock fa-2x"></i>
													 <?php endif; ?>
												 </div>
												 <div class="7u">

													 <!--Debe ser cambiado para los foros-->
													 <a href="temas/<?php echo Url($idforo,$_foros[$idforo]['nombre']); ?>">
													 <?php echo $_foros[$idforo]['nombre']; ?></a> <br>

													 <?php echo $_foros[$idforo]['desc']; ?>
												 </div>

												 <div class="2u">
													 <?php echo number_format($_foros[$idforo]['ctemas'],0,',','.'); ?> Temas <br />
													 <?php echo number_format($_foros[$idforo]['cmensajes'],0,',','.'); ?> Mensajes
												 </div>

												 <div class="2u">
													 Ultimo mensaje
												 </div>
											 </div>
											 <?php  } ?>

										 <?php else: ?>

											 <div class="row">
 												<div class="12u">
 													<div class="alert alert-info" role="alert">
 														<strong>Lo sentimos</strong> Aun no se han creado foros.
 													</div>
 												</div>
												<!--/Foros-->
											</div>


										 <?php endif; ?>

											</div>
										</div>

									<?php
									}
									$sql->close();

										 ?>

								</section>
							</div>
						</div>
						<!--./Categorias-->

					<?php } else { ?>
						<!--Sin Categorias-->
						<div class="row">
							<div class="12u">
								<section>

									<div class="panel panel-primary">
										<div class="panel-heading">
											<h3 class="panel-title">Titulo categoria</h3>
										</div>
										<div class="panel-body">

											<div class="row">
												<div class="12u">
													<div class="alert alert-info" role="alert">
														<strong>Lo sentimos</strong> Aun no se han creado categorias.
													</div>
												</div>
											</div>


										</div>
									</div>

								</section>
							</div>
						</div>
						<!--./Sin Categorias-->
					<?php
						}
				  ?>

			</div>
			<!-- Main -->

		</div>
	<!-- /Main -->

<?php include(HTML_DIR.'layouts/footer.php'); ?>
	</body>
</html>
