<title>Admin - Fsrf (Sugerencias, Reclamos, Felicitaciones)</title>
<div class="col py-2">
    <div class="container-lg">
        <div class="row">
            <h1 class="fw-bolder">Fsrf</h1>
			<h3>(Sugerencias, Reclamos, Felicitaciones)</h3>
            <hr>
			<div class="d-inline-flex gap-1 mb-3">
				
			</div>
			

	<?php
		use app\controllers\fsrfController;

		$insFsrf = new fsrfController();

		echo $insFsrf->listarFsrfControlador($url[1],15,$url[0],"");
	?>
	</div>
</div>
</div>