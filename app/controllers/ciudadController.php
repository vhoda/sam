<?php

	namespace app\controllers;
	use app\models\mainModel;

	class ciudadController extends mainModel{

		/*----------  Controlador registrar usuario  ----------*/
		public function registrarCiudadControlador(){

			# Almacenando datos#
		    $region=$this->limpiarCadena($_POST['region']);
		    $ciudad=$this->limpiarCadena($_POST['ciudad']);
            
		    $longitud=$this->limpiarCadena($_POST['longitud']);
		    $latitud=$this->limpiarCadena($_POST['latitud']);

		    # Verificando campos obligatorios #
		    if($region=="" || $ciudad=="" || $longitud=="" || $latitud==""){
		    	$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No has llenado todos los campos que son obligatorios",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }

            $check_ciudad=$this->ejecutarConsulta("SELECT ciudad FROM estacion WHERE ciudad='$ciudad'");
		    if($check_ciudad->rowCount()>0){
		    	$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"Esta ciudad ingresado ya se encuentra registrado, por favor elija otro",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }

		    $ciudad_datos_reg=[
				[
					"campo_nombre"=>"region",
					"campo_marcador"=>":Region",
					"campo_valor"=>$region
				],
				[
					"campo_nombre"=>"ciudad",
					"campo_marcador"=>":Ciudad",
					"campo_valor"=>$ciudad
				],
				[
					"campo_nombre"=>"longitud",
					"campo_marcador"=>":Longitud",
					"campo_valor"=>$longitud
				],
				[
					"campo_nombre"=>"latitud",
					"campo_marcador"=>":Latitud",
					"campo_valor"=>$latitud
				]
			];

			$registrar_ciudad=$this->guardarDatos("estacion",$ciudad_datos_reg);

			if($registrar_ciudad->rowCount()==1){
				$alerta=[
					"tipo"=>"limpiar",
					"titulo"=>"Ciudad registrado",
					"texto"=>".. ".$region." ".$ciudad." se registro con exito",
					"icono"=>"success"
				];
			}else{
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No se pudo registrar esta ciudad, por favor intente nuevamente",
					"icono"=>"error"
				];
			}

			return json_encode($alerta);

		}

		/*----------  Controlador listar usuario  ----------*/
		public function listarCiudadControlador($pagina,$registros,$url,$busqueda){

			$pagina=$this->limpiarCadena($pagina);
			$registros=$this->limpiarCadena($registros);

			$url=$this->limpiarCadena($url);
			$url=APP_URL.$url."/";

			$busqueda=$this->limpiarCadena($busqueda);
			$tabla="";

			$pagina = (isset($pagina) && $pagina>0) ? (int) $pagina : 1;
			$inicio = ($pagina>0) ? (($pagina * $registros)-$registros) : 0;

			if(isset($busqueda) && $busqueda!=""){

				$consulta_datos="SELECT * FROM estacion WHERE ((estacionid!='".$_SESSION['id']."' AND estacionid!='1') AND (region LIKE '%$busqueda%' OR ciudad LIKE '%$busqueda%' OR longitud LIKE '%$busqueda%' OR latitud LIKE '%$busqueda%')) ORDER BY region ASC LIMIT $inicio,$registros";

				$consulta_total="SELECT COUNT(estacionid) FROM estacion WHERE ((estacionid!='".$_SESSION['id']."' AND estacionid!='1') AND (region LIKE '%$busqueda%' OR ciudad LIKE '%$busqueda%' OR longitud LIKE '%$busqueda%' OR latitud LIKE '%$busqueda%'))";

			}else{

				$consulta_datos="SELECT * FROM estacion WHERE estacionid!='".$_SESSION['id']."' AND estacionid!='1' ORDER BY region ASC LIMIT $inicio,$registros";

				$consulta_total="SELECT COUNT(estacionid) FROM estacion WHERE estacionid!='".$_SESSION['id']."' AND estacionid!='1'";

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
		                    <th  scope="col text-center">Región</th>
		                    <th  scope="col text-center">Ciudad</th>
		                    <th  scope="col text-center">Longitud</th>
                            <th  scope="col text-center">Latitud</th>
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
							<td>'.$rows['region'].'</td>
							<td>'.$rows['ciudad'].'</td>
							<td>'.$rows['longitud'].'</td>
							<td>'.$rows['latitud'].'</td>
			                <td>
							<div class="d-inline-flex gap-1">
			                    <a href="'.APP_URL.'userUpdateCiudad/'.$rows['estacionid'].'/" class="btn btn-success"><i class="bi bi-pencil-square"></i> Editar</a>
								
			                	<form class="FormularioAjax" action="'.APP_URL.'app/ajax/ciudadAjax.php" method="POST" autocomplete="off" >

			                		<input type="hidden" name="modulo_ciudad" value="eliminar">
			                		<input type="hidden" name="estacionid" value="'.$rows['estacionid'].'">

			                    	<button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"></i> Eliminar</button>
			                    </form>
							</div>
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
			                <td colspan="7">
			                    <a href="'.$url.'1/" class="btn btn-success">
			                        Haga clic acá para recargar el listado
			                    </a>
			                </td>
			            </tr>
					';
				}else{
					$tabla.='
						<tr  scope="col text-center" >
			                <td colspan="7">
							<div class="alert alert-warning" role="alert">
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
				$tabla.='<p class="h6">Mostrando ciudades <strong>'.$pag_inicio.'</strong> al <strong>'.$pag_final.'</strong> de un <strong>total de '.$total.'</strong></p>';

				$tabla.=$this->paginadorTablas($pagina,$numeroPaginas,$url,7);
			}

			return $tabla;
		}


		/*----------  Controlador eliminar usuario  ----------*/
		public function eliminarCiudadControlador(){

			$id=$this->limpiarCadena($_POST['estacionid']);

			if($id==1){
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No podemos eliminar la ciudad del sistema.",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
			}

			# Verificando usuario #
		    $datos=$this->ejecutarConsulta("SELECT * FROM estacion WHERE estacionid='$id'");
		    if($datos->rowCount()<=0){
		        $alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No hemos encontrado esta ciudad en el sistema",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }else{
		    	$datos=$datos->fetch();
		    }

		    $eliminarCiudad=$this->eliminarRegistro("estacion","estacionid",$id);

		    if($eliminarCiudad->rowCount()==1){

		        $alerta=[
					"tipo"=>"recargar",
					"titulo"=>"Ciudad eliminado",
					"texto"=>" ".$datos['region']." ".$datos['ciudad']." ha sido eliminado del sistema correctamente",
					"icono"=>"success"
				];

		    }else{

		    	$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No hemos podido eliminar la ".$datos['region']." ".$datos['ciudad']." del sistema, por favor intente nuevamente",
					"icono"=>"error"
				];
		    }

		    return json_encode($alerta);
		}


		/*----------  Controlador actualizar usuario  ----------*/
		public function actualizarCiudadControlador(){

			$id=$this->limpiarCadena($_POST['estacionid']);

			# Verificando usuario #
		    $datos=$this->ejecutarConsulta("SELECT * FROM estacion WHERE estacionid='$id'");
		    if($datos->rowCount()<=0){
		        $alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No hemos encontrado la ciudad en el sistema",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }else{
		    	$datos=$datos->fetch();
		    }

			# Almacenando datos#
		    $region=$this->limpiarCadena($_POST['region']);
		    $ciudad=$this->limpiarCadena($_POST['ciudad']);
		    $longitud=$this->limpiarCadena($_POST['longitud']);
		    $latitud=$this->limpiarCadena($_POST['latitud']);

		    # Verificando campos obligatorios #
		    if($region=="" || $ciudad=="" || $longitud=="" || $latitud==""){
		        $alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No has llenado todos los campos que son obligatorios",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }


            # Verificando usuario #
            if($datos['ciudad']!=$ciudad){
			    $check_ciudad=$this->ejecutarConsulta("SELECT ciudad FROM estacion WHERE ciudad='$ciudad");
			    if($check_ciudad->rowCount()>0){
			        $alerta=[
						"tipo"=>"simple",
						"titulo"=>"Ocurrió un error inesperado",
						"texto"=>"El RUT ingresado ya se encuentra registrado, por favor elija otro",
						"icono"=>"error"
					];
					return json_encode($alerta);
			        exit();
			    }
            }

            $ciudad_datos_up=[
				[
					"campo_nombre"=>"region",
					"campo_marcador"=>":Region",
					"campo_valor"=>$region
				],
				[
					"campo_nombre"=>"ciudad",
					"campo_marcador"=>":Ciudad",
					"campo_valor"=>$ciudad
				],
				[
					"campo_nombre"=>"longitud",
					"campo_marcador"=>":Longitud",
					"campo_valor"=>$longitud
				],
				[
					"campo_nombre"=>"latitud",
					"campo_marcador"=>":Latitud",
					"campo_valor"=>$latitud
				]
			];

			$condicion=[
				"condicion_campo"=>"estacionid",
				"condicion_marcador"=>":ID",
				"condicion_valor"=>$id
			];

			if($this->actualizarDatos("estacion",$ciudad_datos_up,$condicion)){

				if($id==$_SESSION['id']){
					$_SESSION['region']=$region;
					$_SESSION['ciudad']=$ciudad;
					$_SESSION['longitud']=$longitud;
                    $_SESSION['latitud']=$longitud;
				}

				$alerta=[
					"tipo"=>"recargar",
					"titulo"=>"Usuario actualizado",
					"texto"=>"Los datos de ".$datos['region']." ".$datos['ciudad']." se actualizaron correctamente.",
					"icono"=>"success"
				];
			}else{
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No hemos podido actualizar los datos de ".$datos['region']." ".$datos['ciudad'].", por favor intente nuevamente.",
					"icono"=>"error"
				];
			}

			return json_encode($alerta);
		}

	}