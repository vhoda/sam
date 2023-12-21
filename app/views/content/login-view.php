
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo APP_NAME; ?>Login</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary ">
		<div class="container">
		<a class="navbar-brand">SAM</a>
		</div>
	</nav>


 <!---ESTRUCTURA PRINCIPAL-->
<div class="col py-3">
	<div class="container-lg">
  		<div class="row">
    	<div class="col-md-4">

    </div>
    	<div class="col-md-4" style="margin-top:20px;">

     	 <div class="card shadow-sm">
        	<div class="card-body">

				<form  action="" method="POST" autocomplete="off" >
					<h2 class="fw-bolder ">Bienvenido(a)</h2>
					<span class="">Ingrese sus datos para Acceder</span>
					<hr>

					<div class="mb-3 col-auto">
							<input class="form-control" type="text" name="login_usuario" maxlength="20" placeholder="RUT (Sin puntos ni Guión)"  >
					</div>

					<div class="col-auto">
							<input class="form-control" type="password" name="login_clave" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" placeholder="Clave"  >
						</div>
					</div>
					<div class="container">
					<div class="mb-3 container d-flex justify-content-center gap-2">
					<input type="checkbox" class="btn-check" id="btn-check-outlined" autocomplete="off">
					<label class="btn btn-outline-secondary" for="btn-check-outlined">Recuerdame</label>

					
					<button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal2">¿Olvidó su Clave?</button>
					</div>
					</div>
					
					
					<div class="container d-grid gap-2 mb-3">
					<button type="submit" class="btn btn-success"><i class="bi bi-arrow-return-right"></i> Iniciar Sesión</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Modal para clave olvidada -->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered"">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Recuperar Clave</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
	  	<form  action="" method="POST" autocomplete="off" >
		  <p class="fw-bolder">Ingresa tu RUT para iniciar recuperación de contraseña:</p>
			<div class="mb-3 col-auto">
					<input class="form-control" type="text" name="login_usuario" maxlength="20" placeholder="RUT (Sin puntos ni Guión)"  >
			</div>
		</div>
		</form>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success">Recuperar Clave</button>
      </div>
    </div>
  </div>
</div>

<!---------------------------------------->

	<div class="container text-center" style="padding-top: 15px;">
    <div class="text-center">
    <div class="mb-3 text-center">
		<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
		<i class="bi bi-envelope-plus-fill"></i> Solicitar Registro
	</button>
	</div>
    </div>
    </div>


<!-- Modal para Registro -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Solicitar Registro</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
	  <form class="FormularioAjax" action="<?php echo APP_URL; ?>app/ajax/solicitudAjax.php" method="POST" autocomplete="off" enctype="multipart/form-data" >

		<input type="hidden" name="modulo_solicitud" value="registrar">

			<label class="form-label fw-semibold">Nombres</label>
			  <input class="form-control" type="text" name="solicitud_nombre" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required >

			<label class="form-label fw-semibold">Apellidos</label>
			  <input class="form-control" type="text" name="solicitud_apellido" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required >

			<label class="form-label fw-semibold">RUT</label>
			  <input class="form-control" type="text" name="solicitud_rut"  placeholder="Sin puntos ni Guión (12345678k)" maxlength="11" required >

			<label class="form-label fw-semibold">Email</label>
			  <input class="form-control mb-3" type="email" name="solicitud_email" placeholder="correo@dominio.cl" maxlength="70" >
			<p class="form-label ">Despúes de solicitar, se enviará un correo de su solicitud, al momento de aprobar se entregará credenciales para ingresar.</p>
			<hr>
			<div class="float-end">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn btn-success"><i class="bi bi-journal-plus"></i> Enviar Solicitud</button>
			</div>
      </div>
    </div>
  </div>
</div>
<!---------------------->
<?php
	if(isset($_POST['login_usuario']) && isset($_POST['login_clave'])){
		$insLogin->iniciarSesionControlador();
	}
?>