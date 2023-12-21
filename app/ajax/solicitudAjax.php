<?php
	
	require_once "../../config/app.php";
	require_once "../views/inc/session_start.php";
	require_once "../../autoload.php";
	
	use app\controllers\solicitudController;

	if(isset($_POST['modulo_solicitud'])){

		$insSolicitud = new solicitudController();

		if($_POST['modulo_solicitud']=="registrar"){
			echo $insSolicitud->registrarSolicitudControlador();
		}

		if($_POST['modulo_solicitud']=="eliminar"){
			echo $insSolicitud->eliminarSolicitudControlador();
		}

		if($_POST['modulo_solicitud']=="aceptar"){
			echo $insSolicitud->aceptarSolicitudControlador();
		}

	}else{
		session_destroy();
		header("Location: ".APP_URL."login/");
	}