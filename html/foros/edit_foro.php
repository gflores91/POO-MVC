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
						Aviso: El foro ha sido editada correctamente.
					</div>
					</div>';
				}
				if (isset($_GET[error])) {
						echo
						'
						<div class="container">
						<div class="alert alert-danger" role="alert" align="center">
              Lo sentimos: El foro no ha sido editada correctamente.
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
											<a href="?view=categorias" class="btn btn-primary">
												Gestionar Categorias
											</a>
									 </div>

									 <div class="btn-group btn-group-lg">
											<a href="?view=foros" class="btn btn-primary">
													Gestionar Foros
											</a>
										</div>

									</section>

							 </div>
						 </div>
						</div>

				<?php endif; ?>
				<!--/Links administrador-->



				<!--Foros-->
				<div class="row">
					<div class="12u">
						<section>

							<div class="panel panel-primary">
							  <div class="panel-heading">
							    <h3 class="panel-title">Crear foro</h3>
							  </div>
							  <div class="panel-body">


									<div class="row">
										<div class="8u">

                      <form class="form-horizontal" action="?view=foros&mode=edit&id=<?php echo $_GET['id']?>" method="POST" enctype="application/x-www-form-urlencoded">

												<div class="form-group">
													<label for="nombre" class="col-sm-2 control-label">Nombre</label>
													<div class="col-sm-10">
														<input type="text" class="form-control" name="nombre" maxlength="250" value="<?php echo $_foros[$_GET['id']]['nombre']?>">
													</div>
												</div>

												<div class="form-group">
													<label for="desc" class="col-sm-2 control-label">Descripcion</label>
													<div class="col-sm-10">
														<textarea name="desc" class="form-control" rows="6" maxlength="250"><?php echo $_foros[$_GET['id']]['desc']?></textarea>
													</div>
												</div>

												<div class="form-group">
													<label for="catid" class="col-sm-2 control-label">Categoria</label>
													<div class="col-sm-10">
														<select name="catid" class="form-control">
															<?php
																		foreach ($_categorias as $categoriaid => $ccontent) {
																			if ($categoriaid == $_foros[$_GET['id']]['id']) {
																				echo '<option value="'.$categoriaid.'" selected>'.$_categorias[$categoriaid]['nombre'].'</option>';
																			} else {
																				echo '<option value="'.$categoriaid.'">'.$_categorias[$categoriaid]['nombre'].'</option>';
																			}

																		}

															?>
														</select>
													</div>
												</div>

												<div class="form-group">
													<label for="estado" class="col-sm-2 control-label">Estado</label>
													<div class="col-sm-10">

														<div class="radio">
															<label>
																<input type="radio" name="estado" value="1"
																<?php
																	if ($_foros[$_GET['id']]['estado']== 1) {
																		echo "checked";
																	}
																?>
																>
																Abierto
															</label>
														</div>
														<div class="radio">
															<label>
																<input type="radio" name="estado" value="0"
																<?php
																	if ($_foros[$_GET['id']]['estado']== 0) {
																		echo "checked";
																	}
																?>
																>
																Cerrado
															</label>
														</div>

													</div>
												</div>




                        <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success">Editar</button>
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
				<!--./Foros-->

			</div>
			<!-- Main -->

		</div>
	<!-- /Main -->

<?php include(HTML_DIR.'layouts/footer.php'); ?>
	</body>
</html>
