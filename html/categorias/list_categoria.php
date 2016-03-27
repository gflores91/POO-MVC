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

                   <div class="btn-group btn-group-lg">
											<a href="?view=categorias&mode=create" class="btn btn-primary">
												Crear Categoria
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
							    <h3 class="panel-title">Gestion de categorias</h3>
							  </div>
							  <div class="panel-body">



									<div class="row">
										<div class="12u">

                      <?php

                      if ($db->rows($sql) > 0) {
                        $table=
                        '
                        <table class="table">
                          <thead>
                            <th>
                              id
                            </th>
                            <th>
                              Nombre Categoria
                            </th>
                            <th>

                            </th>
                          </thead>

                          <tbody>
                        ';
                        while ($data = $db->recorrer($sql)) {
                          $table .=
                          '
                          <tr>
                            <td>
                              '.$data['categoriaid'].'
                            </td>
                            <td>
                              '.$data['categorianombre'].'
                            </td>
                            <td>
                              <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Elija una accion <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                  <li><a href="?view=categorias&mode=edit&id='.$data['categoriaid'].'">Editar</a></li>
                                  <li><a onclick="DeleteItem(\'¿Esta seguro que desea eliminar?\',\'?view=categorias&mode=delete&id='.$data['categoriaid'].'\')">Eliminar</a></li>
                                </ul>
                              </div>
                            </td>
                          </tr>
                          ';
                        }

                        $table .=
                        '
                        </tbody>
                      </table>
                        ';
                      }else {
                        $table=
                        '
                        <div class="alert alert-dismissible alert-info">
                          <strong>Lo sentimos</strong> primero debe crear una categoria.
                        </div>
                        ';
                      }

                      echo $table;

                       ?>




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
