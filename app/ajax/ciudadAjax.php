<?php
	
	require_once "../../config/app.php";
	require_once "../views/inc/session_start.php";
	require_once "../../autoload.php";
	
	use app\controllers\ciudadController;

	if(isset($_POST['modulo_ciudad'])){

		$insCiudad = new ciudadController();

		if($_POST['modulo_ciudad']=="registrar"){
			echo $insCiudad->registrarCiudadControlador();
		}

		if($_POST['modulo_ciudad']=="eliminar"){
			echo $insCiudad->eliminarCiudadControlador();
		}

		if($_POST['modulo_ciudad']=="actualizar"){
			echo $insCiudad->actualizarCiudadControlador();
		}
		
	}else{
		session_destroy();
		header("Location: ".APP_URL."login/");
	}