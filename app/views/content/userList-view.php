<title>Admin - Lista de Usuarios</title>
<div class="col py-2">
    <div class="container-lg">
        <div class="row">
            <h1 class="fw-bolder">Usuarios</h1>
			<h3>Lista de usuarios</h3>
            <hr>
			<div class="d-inline-flex gap-1 mb-3">
				<a type="button" class="btn btn-success" href="<?php echo APP_URL."userSearch/"?>">
				<i class="bi bi-search"></i> Buscar Usuarios
				</a>

				<a href="<?php echo APP_URL."userNew/"?>" class="btn btn-success"><i class="bi bi-person-fill-add"></i> Agregar Usuario</a>
			</div>
			

	<?php
		use app\controllers\userController;

		$insUsuario = new userController();

		echo $insUsuario->listarUsuarioControlador($url[1],10,$url[0],"");
	?>
	</div>
</div>
</div>
