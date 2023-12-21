<title>Admin - Agregar usuario</title>
<div class="col py-2">
    <div class="container-lg">
        <div class="row">
            <h1 class="fw-bolder">Usuarios</h1>
			<h3>Solicitudes de Registro</h3>
            <hr>


            
	<?php
		use app\controllers\solicitudController;

		$insSolicitud = new solicitudController();

		echo $insSolicitud->listarSolicitudControlador($url[1],15,$url[0],"");
	?>
	</div>
</div>

</div>
</div>

