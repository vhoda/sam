
<title>Actualizar ciudad / </title>

<div class="col py-2">
    <div class="container">
            <div class="col">
             <div class="card shadow-sm">
                 <div class="card-body">
				 	<div class="container is-fluid mb-6">
						<?php 

							$id=$insLogin->limpiarCadena($url[1]);

							if($id==$_SESSION['id']){ 
						?>
						<?php }else{ ?>
						<h1>Ciudad</h1>
						<h2>Actualizar Ciudad</h2>
						<?php } ?>
					</div>
						<hr>
						<div class="container">
						<?php

							$datos=$insLogin->seleccionarDatos("Unico","estacion","estacionid",$id);

							if($datos->rowCount()==1){
								$datos=$datos->fetch();
						?>

								<form class="FormularioAjax" action="<?php echo APP_URL; ?>app/ajax/ciudadAjax.php" method="POST" autocomplete="off" >

									<input type="hidden" name="modulo_ciudad" value="actualizar">
									<input type="hidden" name="estacionid" value="<?php echo $datos['estacionid']; ?>">
									<div class="col mb-3">
									<div class="card shadow-sm">
 									 	<div class="card-body">
												<label class="fw-semibold">Region</label>
												<input class="form-control" type="text" name="region" value="<?php echo $datos['region']; ?>" required >
												<label class="fw-semibold">Ciudad</label>
												<input class="form-control" type="text" name="ciudad" value="<?php echo $datos['ciudad']; ?>" required >
												<label class="fw-semibold">Longitud</label>
												<input class="form-control" type="text" name="longitud" value="<?php echo $datos['longitud']; ?>" required >
												<label class="fw-semibold">Latitud</label>
												<input class="form-control" type="text" name="latitud" value="<?php echo $datos['latitud']; ?>" >
										</div>
									</div>
									</div>
									
									<div class="col mb-3"></div>
									<button type="submit" class="btn btn-success"><i class="bi bi-pencil-square"></i> Actualizar Perfil</button>
								</form>
								<?php
									}else{
										include "./app/views/inc/error_alert.php";
									}
								?>
							</div>	
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

