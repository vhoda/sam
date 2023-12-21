
<title>Aceptar solicitud/ </title>

<div class="col py-3">
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
						<h1>Usuarios</h1>
						<h6>Aceptar usuario <span class="badge bg-secondary">(id Usuario: <?php echo $id; ?>)</span></h6>
						<?php } ?>
					</div>
						<hr>
						<div class="container">
						<?php

							$datos=$insLogin->seleccionarDatos("Unico","solicitud","idsolicitud",$id);

							if($datos->rowCount()==1){
								$datos=$datos->fetch();
						?>

                        <form class="FormularioAjax" action="<?php echo APP_URL; ?>app/ajax/solicitudAjax.php" method="POST" autocomplete="off" enctype="multipart/form-data" >

                        <input type="hidden" name="modulo_solicitud" value="aceptar">

                                    <label class="form-label fw-semibold">Nombres</label>
                                    <input class="form-control" type="text" name="solicitud_nombre" value="<?php echo $datos['solicitud_nombre']; ?>" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required>

                                    <label class="form-label fw-semibold">Apellidos</label>
                                    <input class="form-control" type="text" name="solicitud_apellido" value="<?php echo $datos['solicitud_apellido']; ?>" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required>

                                    <label class="form-label fw-semibold">RUT</label>
                                    <input class="form-control" type="text" name="solicitud_usuario"  value="<?php echo $datos['solicitud_rut']; ?>" maxlength="11" required>

                                    <label class="form-label fw-semibold">Email</label>
                                    <input class="form-control mb-2" type="email" name="solicitud_email" value="<?php echo $datos['solicitud_email']; ?>" maxlength="70">

                                    <p>
                                    Debe asignar una clave aleatoria.
                                    <br>
                                    Página para asignar clave aleatoria: 
                                    <a class="icon-link icon-link-hover" target="_blank" href="https://www.clavesegura.org/en/">
                                        Aquí
                                        <i class="bi bi-box-arrow-up-right"></i><use xlink:href="#arrow-right"></use></i>
                                        </a><br>
                
                                    <label class="form-label fw-semibold">Clave</label>
                                    <input class="form-control" type="password" name="solicitud_clave_1" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100">

                                    <label class="form-label fw-semibold">Repetir clave</label>
                                    <input class="form-control" type="password" name="solicitud_clave_2" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" >
                                    <div class="col"><br>
                                        <button type="reset" class="btn btn-secondary"><i class="bi bi-eraser-fill"></i> Limpiar</button>
                                        <button type="submit" class="btn btn-success"><i class="bi bi-floppy-fill"></i> Guardar</button>
                                </div>
                            </div>
                        </div>

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

