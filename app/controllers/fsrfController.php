<?php

	namespace app\controllers;
	use app\models\mainModel;

	class fsrfController extends mainModel{

		/*----------  Controlador registrar usuario  ----------*/
		public function registrarFsrfControlador(){

			# Almacenando datos#
			$nombres=$this->limpiarCadena($_POST['nombres']);
		    $apellido=$this->limpiarCadena($_POST['apellido']);

		    $rut=$this->limpiarCadena($_POST['rut']);
		    $email=$this->limpiarCadena($_POST['email']);
		    $motivo=$this->limpiarCadena($_POST['motivo']);
		    $mensaje=$this->limpiarCadena($_POST['mensaje']);
		     
			if($nombres=="" || $apellido=="" || $rut=="" || $email=="" || $motivo=="" || $mensaje==""){
		    	$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No has llenado todos los campos que son obligatorios",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }

		    $fsrf_datos_reg=[
				[
					"campo_nombre"=>"nombres",
					"campo_marcador"=>":Nombres",
					"campo_valor"=>$nombres
				],
				[
					"campo_nombre"=>"apellido",
					"campo_marcador"=>":Apellido",
					"campo_valor"=>$apellido
				],
				[
					"campo_nombre"=>"rut",
					"campo_marcador"=>":Rut",
					"campo_valor"=>$rut
				],
				[
					"campo_nombre"=>"email",
					"campo_marcador"=>":Email",
					"campo_valor"=>$email
				],
				[
					"campo_nombre"=>"motivo",
					"campo_marcador"=>":Motivo",
					"campo_valor"=>$motivo
				],
				[
					"campo_nombre"=>"mensaje",
					"campo_marcador"=>":Mensaje",
					"campo_valor"=>$mensaje
				]
			];

			$registrar_fsrf=$this->guardarDatos("fsrf",$fsrf_datos_reg);

			if($registrar_fsrf->rowCount()==1){
				$alerta=[
					"tipo"=>"limpiar",
					"titulo"=>"Usuario registrado",
					"texto"=>"¡Su Comentario se a enviado con éxito!",
					"icono"=>"success"
				];
			}else{
				
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No se pudo registrar su comentario, por favor intente nuevamente",
					"icono"=>"error"
				];
			}

			return json_encode($alerta);

		}

		/*----------  Controlador listar usuario  ----------*/
		public function listarFsrfControlador($pagina,$registros,$url,$busqueda){

			$pagina=$this->limpiarCadena($pagina);
			$registros=$this->limpiarCadena($registros);

			$url=$this->limpiarCadena($url);
			$url=APP_URL.$url."/";

			$busqueda=$this->limpiarCadena($busqueda);
			$tabla="";

			$pagina = (isset($pagina) && $pagina>0) ? (int) $pagina : 1;
			$inicio = ($pagina>0) ? (($pagina * $registros)-$registros) : 0;

			if(isset($busqueda) && $busqueda!=""){

				$consulta_datos="SELECT * FROM fsrf WHERE ((id_frf!='".$_SESSION['id']."' AND id_frf!='1') AND (nombres LIKE '%$busqueda%' OR apellido LIKE '%$busqueda%' OR rut LIKE '%$busqueda%' OR email LIKE '%$busqueda%')) ORDER BY nombres ASC LIMIT $inicio,$registros";

				$consulta_total="SELECT COUNT(id_frf) FROM fsrf WHERE ((id_frf!='".$_SESSION['id']."' AND id_frf!='1') AND (nombres LIKE '%$busqueda%' OR apellido LIKE '%$busqueda%' OR rut LIKE '%$busqueda%' OR email LIKE '%$busqueda%'))";

			}else{

				$consulta_datos="SELECT * FROM fsrf WHERE id_frf!='".$_SESSION['id']."' AND id_frf!='1' ORDER BY nombres ASC LIMIT $inicio,$registros";

				$consulta_total="SELECT COUNT(id_frf) FROM fsrf WHERE id_frf!='".$_SESSION['id']."' AND id_frf!='1'";

			}

			$datos = $this->ejecutarConsulta($consulta_datos);
			$datos = $datos->fetchAll();

			$total = $this->ejecutarConsulta($consulta_total);
			$total = (int) $total->fetchColumn();

			$numeroPaginas =ceil($total/$registros);

			$tabla.='
				<div class="card shadow-sm">
				<div class="card-body">
				<div class="overflow-x-auto">
		        <table class="table table-striped">
		            <thead>
		                <tr>
		                    <th  scope="col text-center">#</th>
		                    <th  scope="col text-center">Nombres</th>
		                    <th  scope="col text-center">Apellidos</th>
		                    <th  scope="col text-center">RUT</th>
                            <th  scope="col text-center">Email</th>
							<th  scope="col text-center">Motivo</th>
							<th  scope="col text-center">Mensaje</th>
		                    <th  scope="col text-center" colspan="3">Opciones</th>
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
							<td>'.$rows['nombres'].'</td>
							<td>'.$rows['apellido'].'</td>
							<td>'.$rows['rut'].'</td>
							<td>'.$rows['email'].'</td>
							<td>'.$rows['motivo'].'</td>
							<td>'.$rows['mensaje'].'</td>
			                <td>
							<!----<div class="d-inline-flex gap-1">
			                    <a href="'.APP_URL.'#/'.$rows['id_frf'].'/" class="btn btn-success"><i class="bi bi-pencil-square"></i> Editar</a>
								
			                	<form class="FormularioAjax" action="'.APP_URL.'app/ajax/fsrfAjax.php" method="POST" autocomplete="off" >

			                		<input type="hidden" name="modulo_fsrf" value="eliminar">
			                		<input type="hidden" name="id_frf" value="'.$rows['id_frf'].'">

			                    	<button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"></i> Eliminar</button>
			                    </form>
							</div>--->
			                </td>
						</tr>
					';
					$contador++;
				}
				$pag_final=$contador-1;
			}else{
				if($total>=1){
					$tabla.='
						<tr  scope="col text-center" >
			                <td colspan="8">
			                    <a href="'.$url.'1/" class="btn btn-success">
			                        Haga clic acá para recargar el listado
			                    </a>
			                </td>
			            </tr>
					';
				}else{
					$tabla.='
						<tr  scope="col text-center" >
			                <td colspan="8">
							<div class="alert alert-warning text-center" role="alert">
							<i class="bi bi-exclamation-triangle-fill"></i> <b>No hay registros en el sistema</b>
							</div>
			                </td>
			            </tr>
					';
				}
			}

			$tabla.='</tbody></table></div>';

			### Paginacion ###
			if($total>0 && $pagina<=$numeroPaginas){
				$tabla.='<p class="h6">Mostrando formularios <strong>'.$pag_inicio.'</strong> al <strong>'.$pag_final.'</strong> de un <strong>total de '.$total.'</strong></p>';

				$tabla.=$this->paginadorTablas($pagina,$numeroPaginas,$url,7);
			}

			return $tabla;
		}
		public function eliminarFsrfControlador(){

			$id=$this->limpiarCadena($_POST['id_frf']);

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
		    $datos=$this->ejecutarConsulta("SELECT * FROM fsrf WHERE id_frf='$id'");
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

		    $eliminarFsrf=$this->eliminarRegistro("fsrf","id_frf",$id);

		    if($eliminarFsrf->rowCount()==1){

		        $alerta=[
					"tipo"=>"recargar",
					"titulo"=>"Usuario eliminado",
					"texto"=>"¡El comentario ha sido TERMINADO del sistema correctamente!",
					"icono"=>"success"
				];

		    }else{

		    	$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No se ha podido TERMINAR el comentario del sistema, por favor intente nuevamente",
					"icono"=>"error"
				];
		    }

		    return json_encode($alerta);
		}

	}