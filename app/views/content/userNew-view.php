<title>Admin - Agregar usuario</title>
<div class="col py-2">
    <div class="container-lg">
        <div class="row">
            <h1 class="fw-bolder">Usuarios</h1>
			<h3>Agregar usuario</h3>
            <hr>
</div>

<div class="card shadow-sm">
	<div class="card-body">

	<form class="FormularioAjax" action="<?php echo APP_URL; ?>app/ajax/usuarioAjax.php" method="POST" autocomplete="off" enctype="multipart/form-data" >

		<input type="hidden" name="modulo_usuario" value="registrar">

					<label class="form-label fw-semibold">Nombres</label>
				  	<input class="form-control" type="text" name="usuario_nombre" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required >

					<label class="form-label fw-semibold">Apellidos</label>
				  	<input class="form-control" type="text" name="usuario_apellido" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required >

					<label class="form-label fw-semibold">RUT</label>
				  	<input class="form-control" type="text" name="usuario_usuario"  maxlength="11" required >

					<label class="form-label fw-semibold">Email</label>
				  	<input class="form-control" type="email" name="usuario_email" maxlength="70" >


					<label class="form-label fw-semibold">Clave</label>
				  	<input class="form-control" type="password" name="usuario_clave_1" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required >

					<label class="form-label fw-semibold">Repetir clave</label>
				  	<input class="form-control" type="password" name="usuario_clave_2" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required >
					<div class="col"><br>
					<div class="input-group mb-3">
						<label class="input-group-text" for="inputGroupFile01">Subir Foto (opcional)</label>
						<input type="file" name="usuario_foto" accept=".jpg, .png, .jpeg"  class="form-control" id="inputGroupFile01">
						
					</div>
					</div>
					<span class="file-name">Se Acepta formatos: JPG, JPEG, PNG. (MAX 5MB)</span>
					<div class="col mb-3"></div>
						<button type="reset" class="btn btn-secondary"><i class="bi bi-eraser-fill"></i> Limpiar</button>
						<button type="submit" class="btn btn-success"><i class="bi bi-floppy-fill"></i> Guardar</button>
				</div>
		  	</div>
		</div>
		
	</form>
</div>
</div>