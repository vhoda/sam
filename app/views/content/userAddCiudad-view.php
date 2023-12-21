<title>Admin - Agregar ciudad</title>
<div class="col py-3">
    <div class="container-lg">
        <div class="row">
            <h1 class="fw-bolder">Ciudad</h1>
			<h3>Agregar Ciudad</h3>
            <hr>
</div>

<div class="card shadow-sm">
	<div class="card-body">

	<form class="FormularioAjax" action="<?php echo APP_URL; ?>app/ajax/ciudadAjax.php" method="POST" autocomplete="off" enctype="multipart/form-data" >

		<input type="hidden" name="modulo_ciudad" value="registrar">

					<label class="form-label fw-semibold">Region</label>
				  	<select class="form-select form-control" name="region" aria-label="Default select example">
                        <option selected>Haga click para seleccionar región</option>
                        <option value="Bío-Bío">Bío-Bío</option>
                        <option value="Ñuble">Ñuble</option>
                        <option value="Araucanía">Araucanía</option>
                    </select>

					<label class="form-label fw-semibold">Ciudad</label>
				  	<input class="form-control" type="text" name="ciudad">

					<label class="form-label fw-semibold">Longitud </label> <a href="#"  data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="bi bi-question-circle-fill"></i></a>
				  	<input class="form-control" placeholder="Ej: -36.8024511" type="text" name="longitud">

					<label class="form-label fw-semibold">Latitud</label>
				  	<input class="form-control" placeholder="Ej: -73.0479413"  type="text" name="latitud">

					<div class="col mb-3"></div>
						<button type="reset" class="btn btn-secondary"><i class="bi bi-eraser-fill"></i> Limpiar</button>
						<button type="submit" class="btn btn-success"><i class="bi bi-floppy-fill"></i> Guardar</button>
				    </div>
		  	</div>
		</div>
		
	</form>

    <!---modal pregunta-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">¿Cómo extraer Longitud y Latitud?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="fw-normal">Cuando abra a <a href="https://www.google.com/maps/" target="_blank">Google Maps</a>, desde la barra de direccion (URL) están unas coordenadas.</p>
                <img src="<?php echo APP_URL; ?>app/views/img/coordenadas.png" class="img-fluid shadow text-center rounded mb-3" alt="">
                
                <p>Sólo copiar Por Ejemplo: "-36.8024511", Lo mismo Con la Latitud.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>
</div>