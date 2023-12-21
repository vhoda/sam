
<title>Actualizar perfil / </title>

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
						<h1>Mi cuenta</h1>
						<h5 >Editar Perfil</h5>
						<?php }else{ ?>
						<h1>Usuarios</h1>
						<h5>Actualizar usuario <span class="badge bg-secondary">(id Usuario: <?php echo $id; ?>)</span></h5>
						<?php } ?>
					</div>
						<hr>
						<div class="container">
						<?php

							$datos=$insLogin->seleccionarDatos("Unico","usuario","usuario_id",$id);

							if($datos->rowCount()==1){
								$datos=$datos->fetch();
						?>
							
							<p ><?php echo "<strong>Usuario creado:</strong> ".date("d-m-Y  h:i:s A",strtotime($datos['usuario_creado']))." &nbsp; <strong>Usuario actualizado:</strong> ".date("d-m-Y  h:i:s A",strtotime($datos['usuario_actualizado'])); ?></p>

								<form class="FormularioAjax" action="<?php echo APP_URL; ?>app/ajax/usuarioAjax.php" method="POST" autocomplete="off" >

									<input type="hidden" name="modulo_usuario" value="actualizar">
									<input type="hidden" name="usuario_id" value="<?php echo $datos['usuario_id']; ?>">
									<div class="col mb-3">
									<div class="card shadow-sm">
 									 	<div class="card-body">
												<label class="fw-semibold">Nombres</label>
												<input class="form-control" type="text" name="usuario_nombre" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" value="<?php echo $datos['usuario_nombre']; ?>" required >
												<label class="fw-semibold">Apellidos</label>
												<input class="form-control" type="text" name="usuario_apellido" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" value="<?php echo $datos['usuario_apellido']; ?>" required >
												<label class="fw-semibold">RUT (Sin puntos ni guion)</label>
												<input class="form-control" type="text" name="usuario_usuario" maxlength="11" value="<?php echo $datos['usuario_usuario']; ?>" required >
												<label class="fw-semibold">Email</label>
												<input class="form-control" type="email" name="usuario_email" maxlength="70" value="<?php echo $datos['usuario_email']; ?>" >
										</div>
									</div>
									</div>
									<div class="col mb-3">
									<div class="card shadow-sm">
 									 	<div class="card-body">
										<p class="fw-semibold">
											* SI desea actualizar la clave de este usuario por favor llene los 2 campos. Si NO desea actualizar la clave deje los campos vacíos.
											<br>
												<span class="fw-light">
												* La Clave debe tener al menos <strong> 8 caracteres.</strong>
												</span>
												<br>
												<span class="fw-light">
												* La Clave NO puede ser asemejarse tanto a su otra información personal.
												</span>
										</p>
													<label>Nueva clave</label>
													<input class="form-control" type="password" name="usuario_clave_1" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" minlength="8">

													<label>Repetir nueva clave</label>
													<input class="form-control" type="password" name="usuario_clave_2" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" minlength="8">
										</div>
									</div>
									</div>
									<div class="card shadow-sm">
									<div class="card-body">
									<p class="fw-semibold">
										Para poder actualizar los datos de este usuario por favor ingrese su RUT y CLAVE con la que ha iniciado sesión
									</p>
												<label class="fw-semibold">* RUT</label>
												<input class="form-control" type="text" name="administrador_usuario" maxlength="20" >
												<label class="fw-semibold">* Clave</label>
												<input class="form-control" type="password" name="administrador_clave" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" >

										
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

