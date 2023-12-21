<?php
	
	require_once "../../config/app.php";
	require_once "../views/inc/session_start.php";
	require_once "../../autoload.php";
	
	use app\controllers\fsrfController;

	if(isset($_POST['modulo_fsrf'])){

		$insFsrf = new fsrfController();

		if($_POST['modulo_fsrf']=="registrar"){
			echo $insFsrf->registrarFsrfControlador();
		}
		if($_POST['modulo_fsrf']=="eliminar"){
			echo $insFsrf->eliminarFsrfControlador();
		}

	}else{
		session_destroy();
		header("Location: ".APP_URL."login/");
	}