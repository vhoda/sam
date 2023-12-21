<?php
	
	require_once "../../config/app.php";
	require_once "../views/inc/session_start.php";
	require_once "../../autoload.php";
	
	use app\controllers\conteoController;

	if(isset($_POST['modulo_conteo'])){

		$insConteo = new conteoController();

		if($_POST['modulo_conteo']=="conteo"){
			echo $insConteo->contadorUser();
		}
        if($_POST['modulo_conteo']=="conteo2"){
			echo $insConteo->contadorCiudad();
		}
        if($_POST['modulo_conteo']=="conteo3"){
			echo $insConteo->contadorSolicitudes();
		}
        if($_POST['modulo_conteo']=="conteo4"){
			echo $insConteo->contadorFsrf();
		}
		
	}else{
		session_destroy();
		header("Location: ".APP_URL."login/");
	}