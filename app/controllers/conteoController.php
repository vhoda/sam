<?php

	namespace app\controllers;
	use app\models\mainModel;

	class conteoController extends mainModel{
        public function contadorUser(){
            $datos=$this->ejecutarConsulta("SELECT COUNT(usuario_id)
            FROM usuario");
            if($count = $datos->fetchColumn()){
            echo '<span class="fs-4"><span class="badge text-bg-secondary">'.$count.'</span> Registrados</span>';
            }
            else{
                echo '
                <span class="badge text-bg-warning fs-6 text-wrap shadow-sm"><i class="bi bi-exclamation-triangle-fill"></i> <b>No hay Registros en el sistema</b></span>
                ';
            }

        }
        public function contadorCiudad(){
            $datos=$this->ejecutarConsulta("SELECT COUNT(estacionid)
            FROM estacion");
            if($count = $datos->fetchColumn()){
                echo '<span class="fs-4"><span class="badge text-bg-secondary">'.$count.'</span> Registrados</span>';
            }
            else{
                echo '
                <span class="badge text-bg-warning fs-6 text-wrap shadow-sm"><i class="bi bi-exclamation-triangle-fill"></i> <b>No hay Registros en el sistema</b></span>
                ';
            }

        }
        public function contadorSolicitudes(){
            $datos=$this->ejecutarConsulta("SELECT COUNT(idsolicitud)
            FROM solicitud");
            if($count = $datos->fetchColumn()){
                echo '
                <span class="badge text-bg-success fs-5 text-wrap shadow-sm">'.$count.' Nuevas Solicitudes</span>
                ';
            }
            else{
                echo '
                <span class="badge text-bg-warning fs-6 text-wrap shadow-sm"><i class="bi bi-exclamation-triangle-fill"></i> <b>No hay nuevas solicitudes</b></span>
                ';
            }

        }
        public function contadorFsrf(){
            $datos=$this->ejecutarConsulta("SELECT COUNT(id_frf)
            FROM fsrf");
            if($count = $datos->fetchColumn()){
                echo '
                <span class="fs-4"><span class="badge text-bg-secondary">'.$count.'</span> Comentarios</span>';
                
            }
            else{
                echo '
                <span class="badge text-bg-warning fs-6 text-wrap shadow-sm"><i class="bi bi-exclamation-triangle-fill"></i> <b> No hay Registros de Formulario</b></span>
                ';
            }

        }
}