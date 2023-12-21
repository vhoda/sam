<?php

	namespace app\controllers;
	use app\models\mainModel;

	class solicitudController extends mainModel{

		/*----------  Controlador registrar solicitud de usuario  ----------*/
		public function registrarSolicitudControlador(){

			# Almacenando datos#
		    $nombre=$this->limpiarCadena($_POST['solicitud_nombre']);
		    $apellido=$this->limpiarCadena($_POST['solicitud_apellido']);

		    $usuario=$this->limpiarCadena($_POST['solicitud_rut']);
		    $email=$this->limpiarCadena($_POST['solicitud_email']);

		    # Verificando campos obligatorios #
		    if($nombre=="" || $apellido=="" || $usuario==""){
		    	$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No has llenado todos los campos que son obligatorios",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }

		    # Verificando email #
		    if($email!=""){
				if(filter_var($email, FILTER_VALIDATE_EMAIL)){
					$check_email=$this->ejecutarConsulta("SELECT solicitud_email FROM solicitud WHERE solicitud_email='$email'");
					if($check_email->rowCount()>0){
						$alerta=[
							"tipo"=>"simple",
							"titulo"=>"Ocurrió un error inesperado",
							"texto"=>"El EMAIL que acaba de ingresar ya se encuentra registrado en el sistema, por favor verifique e intente nuevamente",
							"icono"=>"error"
						];
						return json_encode($alerta);
						exit();
					}
				}else{
					$alerta=[
						"tipo"=>"simple",
						"titulo"=>"Ocurrió un error inesperado",
						"texto"=>"Ha ingresado un correo electrónico no valido",
						"icono"=>"error"
					];
					return json_encode($alerta);
					exit();
				}
            }

            # Verificando usuario #
		    $check_solicitud=$this->ejecutarConsulta("SELECT solicitud_usuario FROM solicitud WHERE solicitud_usuario='$usuario'");
		    if($check_solicitud->rowCount()>0){
		    	$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"El RUT ingresado ya se encuentra registrado, por favor elija otro",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }
		   
		    $solicitud_datos_reg=[
				[
					"campo_nombre"=>"solicitud_nombre",
					"campo_marcador"=>":Nombre",
					"campo_valor"=>$nombre
				],
				[
					"campo_nombre"=>"solicitud_apellido",
					"campo_marcador"=>":Apellido",
					"campo_valor"=>$apellido
				],
				[
					"campo_nombre"=>"solicitud_rut",
					"campo_marcador"=>":Usuario",
					"campo_valor"=>$usuario
				],
				[
					"campo_nombre"=>"solicitud_email",
					"campo_marcador"=>":Email",
					"campo_valor"=>$email
				]
			];

			$registrar_solicitud=$this->guardarDatos("solicitud",$solicitud_datos_reg);

			if($registrar_solicitud->rowCount()==1){
				$alerta=[
					"tipo"=>"limpiar",
					"titulo"=>"Usuario registrado",
					"texto"=>"¡Estimado, ".$nombre." ".$apellido." Se ha hecho su Solicitud con exito!",
					"icono"=>"success"
				];
			}else{
				
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No se pudo registrar el usuario, por favor intente nuevamente",
					"icono"=>"error"
				];
			}

			return json_encode($alerta);

		}


		/*----------  Controlador listar usuario  ----------*/
		public function listarSolicitudControlador($pagina,$registros,$url,$busqueda){

			$pagina=$this->limpiarCadena($pagina);
			$registros=$this->limpiarCadena($registros);

			$url=$this->limpiarCadena($url);
			$url=APP_URL.$url."/";

			$busqueda=$this->limpiarCadena($busqueda);
			$tabla="";

			$pagina = (isset($pagina) && $pagina>0) ? (int) $pagina : 1;
			$inicio = ($pagina>0) ? (($pagina * $registros)-$registros) : 0;

			if(isset($busqueda) && $busqueda!=""){

				$consulta_datos="SELECT * FROM solicitud WHERE ((idsolicitud!='".$_SESSION['id']."' AND idsolicitud!='1') AND (solicitud_nombre LIKE '%$busqueda%' OR solicitud_apellido LIKE '%$busqueda%' OR solicitud_email LIKE '%$busqueda%' OR solicitud_rut LIKE '%$busqueda%')) ORDER BY solicitud_nombre ASC LIMIT $inicio,$registros";

				$consulta_total="SELECT COUNT(idsolicitud) FROM solicitud WHERE ((idsolicitud!='".$_SESSION['id']."' AND idsolicitud!='1') AND (solicitud_nombre LIKE '%$busqueda%' OR solicitud_apellido LIKE '%$busqueda%' OR solicitud_email LIKE '%$busqueda%' OR solicitud_usuario LIKE '%$busqueda%'))";

			}else{

				$consulta_datos="SELECT * FROM solicitud WHERE idsolicitud!='".$_SESSION['id']."' AND idsolicitud!='1' ORDER BY solicitud_nombre ASC LIMIT $inicio,$registros";

				$consulta_total="SELECT COUNT(idsolicitud) FROM solicitud WHERE idsolicitud!='".$_SESSION['id']."' AND idsolicitud!='1'";

			}

			$datos = $this->ejecutarConsulta($consulta_datos);
			$datos = $datos->fetchAll();

			$total = $this->ejecutarConsulta($consulta_total);
			$total = (int) $total->fetchColumn();

			$numeroPaginas =ceil($total/$registros);

			$tabla.='
            <div class="container mb-3">
				<div class="card shadow-sm">
				<div class="card-body">
				<div class="overflow-x-auto">
		        <table class="table table-striped">
		            <thead>
		                <tr>
		                    <th>#</th>
		                    <th>Nombre</th>
                            <th>Apellido</th>
		                    <th>RUT</th>
		                    <th>Email</th>
		                    <th colspan="3">Opciones</th>
		                </tr>
		            </thead>
		            <tbody>
		    ';

		    if($total>=1 && $pagina<=$numeroPaginas){
				$contador=$inicio+1;
				$pag_inicio=$inicio+1;
				foreach($datos as $rows){
					$tabla.='
						<tr class="" >
							<td>'.$contador.'</td>
							<td>'.$rows['solicitud_nombre'].' 
                            <td>'.$rows['solicitud_apellido'].'</td>
							<td>'.$rows['solicitud_rut'].'</td>
							<td>'.$rows['solicitud_email'].'</td>
			                <td>
							<a href="'.APP_URL.'userSolicitudAceptar/'.$rows['idsolicitud'].'/" class="btn btn-success"><i class="bi bi-check-circle-fill"></i> Validar</a>
			                </td>
			                <td>
			                	<form class="FormularioAjax" action="'.APP_URL.'app/ajax/solicitudAjax.php" method="POST" autocomplete="off" >

			                		<input type="hidden" name="modulo_solicitud" value="eliminar">
			                		<input type="hidden" name="idsolicitud" value="'.$rows['idsolicitud'].'">

			                    	<button type="submit" class="btn btn-danger"><i class="bi bi-dash-circle"></i> Rechazar</button>
			                    </form>
			                </td>
						</tr>
					';
					$contador++;
				}
				$pag_final=$contador-1;
			}else{
				if($total>=1){
					$tabla.='
						<tr class="text-center" >
			                <td colspan="7">
			                    <a href="'.$url.'1/" class="btn btn-success">
			                        Haga clic acá para recargar el listado
			                    </a>
			                </td>
			            </tr>
					';
				}else{
					$tabla.='
						<tr class="text-center" >
			                <td colspan="7">
							<div class="alert alert-primary" role="alert">
							<i class="bi bi-info-circle-fill"></i> <b>No hay registros de Solicitudes</b>
							</div>
			                </td>
			            </tr>
					';
				}
			}

			$tabla.='</tbody></table></div>';

			### Paginacion ###
			if($total>0 && $pagina<=$numeroPaginas){
				$tabla.='<p class="h6">Mostrando usuarios <strong>'.$pag_inicio.'</strong> al <strong>'.$pag_final.'</strong> de un <strong>total de '.$total.'</strong></p>';

				$tabla.=$this->paginadorTablas($pagina,$numeroPaginas,$url,7);
			}

			return $tabla;
		}


		/*----------  Controlador eliminar usuario  ----------*/
		public function eliminarSolicitudControlador(){

			$id=$this->limpiarCadena($_POST['idsolicitud']);

			if($id==1){
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No podemos eliminar el usuario principal del sistema",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
			}

			# Verificando usuario #
		    $datos=$this->ejecutarConsulta("SELECT * FROM solicitud WHERE idsolicitud='$id'");
		    if($datos->rowCount()<=0){
		        $alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No hemos encontrado el usuario en el sistema",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }else{
		    	$datos=$datos->fetch();
		    }

		    $eliminarSolicitud=$this->eliminarRegistro("solicitud","idsolicitud",$id);

		    if($eliminarSolicitud->rowCount()==1){

		        $alerta=[
					"tipo"=>"recargar",
					"titulo"=>"Usuario eliminado",
					"texto"=>"¡El usuario ".$datos['solicitud_nombre']." ".$datos['solicitud_apellido']." ha sido RECHAZADO del sistema correctamente!",
					"icono"=>"success"
				];

		    }else{

		    	$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No hemos podido RECHAZAR el usuario ".$datos['solicitud_nombre']." ".$datos['solicitud_apellido']." del sistema, por favor intente nuevamente",
					"icono"=>"error"
				];
		    }

		    return json_encode($alerta);
		}


		/*----------  Controlador actualizar usuario  ----------*/
		public function aceptarSolicitudControlador(){

			# Almacenando datos#
		    $nombre=$this->limpiarCadena($_POST['solicitud_nombre']);
		    $apellido=$this->limpiarCadena($_POST['solicitud_apellido']);
		    $usuario=$this->limpiarCadena($_POST['solicitud_usuario']);
		    $email=$this->limpiarCadena($_POST['solicitud_email']);
		    $clave1=$this->limpiarCadena($_POST['solicitud_clave_1']);
		    $clave2=$this->limpiarCadena($_POST['solicitud_clave_2']);


		    # Verificando campos obligatorios #
		    if($id="" ||$nombre=="" || $apellido=="" || $usuario=="" || $clave1=="" || $clave2==""){
		    	$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No has llenado todos los campos que son obligatorios",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }

		    # Verificando integridad de los datos #
		    if($this->verificarDatos("[a-zA-Z0-9]{4,20}",$usuario)){
		    	$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"El RUT no coincide con el formato solicitado",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }

		    if($this->verificarDatos("[a-zA-Z0-9$@.-]{7,100}",$clave1) || $this->verificarDatos("[a-zA-Z0-9$@.-]{7,100}",$clave2)){
		    	$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"Las CLAVES no coinciden con el formato solicitado",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }

		    # Verificando email #
		    if($email!=""){
				if(filter_var($email, FILTER_VALIDATE_EMAIL)){
					$check_email=$this->ejecutarConsulta("SELECT usuario_email FROM usuario WHERE usuario_email='$email'");
					if($check_email->rowCount()>0){
						$alerta=[
							"tipo"=>"simple",
							"titulo"=>"Ocurrió un error inesperado",
							"texto"=>"El EMAIL que acaba de ingresar ya se encuentra registrado en el sistema, por favor verifique e intente nuevamente",
							"icono"=>"error"
						];
						return json_encode($alerta);
						exit();
					}
				}else{
					$alerta=[
						"tipo"=>"simple",
						"titulo"=>"Ocurrió un error inesperado",
						"texto"=>"Ha ingresado un correo electrónico no valido",
						"icono"=>"error"
					];
					return json_encode($alerta);
					exit();
				}
            }

            # Verificando claves #
            if($clave1!=$clave2){
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"Las contraseñas que acaba de ingresar no coinciden, por favor verifique e intente nuevamente",
					"icono"=>"error"
				];
				return json_encode($alerta);
				exit();
			}else{
				$clave=password_hash($clave1,PASSWORD_BCRYPT,["cost"=>10]);
            }

            # Verificando usuario #
		    $check_solicitud=$this->ejecutarConsulta("SELECT usuario_usuario FROM usuario WHERE solicitud_rut='$usuario'");
		    if($check_solicitud->rowCount()>0){
		    	$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"El RUT ingresado ya se encuentra registrado, por favor elija otro",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }

		    $usuario_datos_acep=[
				[
					"campo_nombre"=>"usuario_nombre",
					"campo_marcador"=>":Nombre",
					"campo_valor"=>$nombre
				],
				[
					"campo_nombre"=>"usuario_apellido",
					"campo_marcador"=>":Apellido",
					"campo_valor"=>$apellido
				],
				[
					"campo_nombre"=>"usuario_usuario",
					"campo_marcador"=>":Usuario",
					"campo_valor"=>$usuario
				],
				[
					"campo_nombre"=>"usuario_email",
					"campo_marcador"=>":Email",
					"campo_valor"=>$email
				],
				[
					"campo_nombre"=>"usuario_clave",
					"campo_marcador"=>":Clave",
					"campo_valor"=>$clave
				],
				[
					"campo_nombre"=>"usuario_creado",
					"campo_marcador"=>":Creado",
					"campo_valor"=>date("Y-m-d H:i:s")
				],
				[
					"campo_nombre"=>"usuario_actualizado",
					"campo_marcador"=>":Actualizado",
					"campo_valor"=>date("Y-m-d H:i:s")
				]
			];

			$aceptar_usuario=$this->guardarDatos("usuario",$usuario_datos_acep);
			$id=$this->ejecutarConsulta("DELETE FROM solicitud WHERE idsolicitud='$id'");

			if($aceptar_usuario->rowCount()==1){
				
				$alerta=[
					"tipo"=>"limpiar",
					"titulo"=>"Usuario registrado",
					"texto"=>"El usuario ".$nombre." ".$apellido." Se ACEPTÓ con exito!",
					"icono"=>"success"
				];
			}else{		
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No se pudo registrar el usuario, por favor intente nuevamente",
					"icono"=>"error"
				];
			}

			return json_encode($alerta);

		}

		
	}