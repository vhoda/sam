<title>Lista de ciudades</title>
<div class="col py-2">
    <div class="container-lg">
        <div class="row">
            <h1 class="fw-bolder">Ciudad</h1>
			<h4>Lista de Ciudades</h4>
            <hr>
            </div>
			<div class="mb-3">
			<a href="<?php echo APP_URL."userAddCiudad/"?>" class="btn btn-success"><i class="bi bi-pin-angle-fill"></i> Agregar Ciudad</a>
			</div>
           
	<?php
		use app\controllers\ciudadController;

		$insCiudad = new ciudadController();

		echo $insCiudad->listarCiudadControlador($url[1],10,$url[0],"");
	?>
	</div>
</div>
</div>
