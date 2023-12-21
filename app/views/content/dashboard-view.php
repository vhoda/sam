
<title>Dashboard Admin</title>
<!---ESTRUCTURA COMPLETA-->
<section id="loading">
    <div id="loading-content"></div>
</section>

<div class="col py-2">
    <div class="container-lg">
        <div class="row">
            <h1 class="fw-bolder">DashBoard Administrador</h1>
            <hr>
            <div class="d-flex flex-nowrap mb-3 gap-1">
                <a href="<?php echo APP_URL."userAddCiudad/"?>" class="btn btn-success btn-sm"><i class="bi bi-pin-angle-fill"></i> Agregar Ciudad</a>
                <a href="<?php echo APP_URL."userListCiudad/"?>" class="btn btn-success btn-sm"><i class="bi bi-map-fill"></i> Ver Ciudades</a>
                <a href="<?php echo APP_URL."userNew/"?>" class="btn btn-success btn-sm"><i class="bi bi-person-fill-add"></i> Agregar Usuario</a>
                <a href="<?php echo APP_URL."userList/"?>" class="btn btn-success btn-sm"><i class="bi bi-person-lines-fill"></i> Ver Usuarios</a>
                
            </div>
    
            <div class="col-sm-3 mb-3 mb-sm-1">
            <a href="<?php echo APP_URL."userList/"?>" class="link-offset-2 link-underline link-underline-opacity-0">
                <div class="card widget-flat shadow-sm">
                    <div class="card-body">
                                <div class="float-end">
                                <i  class="bi bi-person-lines-fill "></i>
                                </div>
                                <h5 class="text-muted fw-normal mt-0" title="Total de Usuarios">Usuarios</h5>
                                <?php
                                    use app\controllers\conteoController;
                                    $insConteo = new conteoController();
                                    echo $insConteo->contadorUser($url[1],15,$url[0],"");
                                ?>
                                
                    </div> <!-- end card-body-->
                </div>
            </a>
            </div>
            <div class="col-sm-3 mb-3 mb-sm-1">
            <a href="<?php echo APP_URL."userListCiudad/"?>" class="link-offset-2 link-underline link-underline-opacity-0">
                <div class="card widget-flat shadow-sm">
                    <div class="card-body">
                                <div class="float-end">
                                <i class="bi bi-map-fill"></i>
                                </div>
                                <h5 class="text-muted fw-normal mt-0" title="Total de Ciudades">Ciudad</h5>
                                <?php
                                    $insConteo = new conteoController();
                                    echo $insConteo->contadorCiudad($url[1],15,$url[0],"");
                                ?>
                                
                    </div> <!-- end card-body-->
                </div>
            </a>
            </div>
            <div class="col-sm-3 mb-3 mb-sm-1">
                <a href="<?php echo APP_URL."userSolicitud/"?>" class="link-offset-2 link-underline link-underline-opacity-0">
                        <div class="card widget-flat shadow-sm">
                            <div class="card-body">
                                        <div class="float-end">
                                        <i class="bi bi-journal-bookmark-fill"></i>     
                                        </div>
                                        <h5 class="text-muted fw-normal mt-0" title="Solicitudes">Solicitud</h5>
                                        <?php
                                            $insConteo = new conteoController();
                                            echo $insConteo->contadorSolicitudes($url[1],15,$url[0],"");
                                        ?>
                                        
                            </div> <!-- end card-body-->
                        </div>
                </a>
            </div>
                        <div class="col-sm-3 mb-3 mb-sm-1">
                        <a href="<?php echo APP_URL."userFsrf/"?>" class="link-offset-2 link-underline link-underline-opacity-0">
                        <div class="card widget-flat shadow-sm">
                            <div class="card-body">
                                        <div class="float-end">
                                        <i class="bi bi-menu-app"></i>
                                        </div>
                                        <h5 class="text-muted fw-normal mt-0" title="Formulario de Felicitación, Reclamo, Surgerencia">Fsfr</h5>
                                        <?php
                                            $insConteo = new conteoController();
                                            echo $insConteo->contadorFsrf($url[1],15,$url[0],"");
                                        ?>
                                        
                            </div> <!-- end card-body-->
                        </div>
                </a>
                            
            </div>
            <div class="mb-2">
                
            </div>

            <div class="mb-3">
            <button type="button" class="btn btn-success btn-block" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            <i class="bi bi-card-list"></i> Estaciones Disponibles
            </button>   
            </div>
            <!--collapse boton para estaciones--->
            <div class="collapse" id="collapseExample">
            <div class="containter mb-3">
                <ul class="list-group">
                    <li class="list-group-item">
                        <input class="form-check-input me-1" type="checkbox" value="" id="firstCheckbox">
                        <label class="form-check-label" for="firstCheckbox">First checkbox</label>
                    </li>
                    <li class="list-group-item">
                        <input class="form-check-input me-1" type="checkbox" value="" id="secondCheckbox">
                        <label class="form-check-label" for="secondCheckbox">Second checkbox</label>
                    </li>
                    <li class="list-group-item">
                        <input class="form-check-input me-1" type="checkbox" value="" id="thirdCheckbox">
                        <label class="form-check-label" for="thirdCheckbox">Third checkbox</label>
                    </li>
                </ul>
            </div>
            </div>
            <!---termino de collapse---->
            
            <div class="mb-1">
					<p class="fw-bold">Todas las unidades son métricas. Consulte el Diccionario de datos y Estados: <a class="icon-link icon-link-hover" href="#diccionario">
                    Aquí
                    <i class="bi bi-arrow-up-right-square-fill"></i><use xlink:href="#arrow-right"></use></i>
                    </a>
			</div>

            <!---CIUDADES-->
                <div class="col mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="float-end">
                                <div class="vr"></div>
                                <a class="btn"><i class="bi bi-pencil-fill text-secondary"></i></a>
                                <button type="button" class="btn-close" aria-label="Close"></button>
                            </div>
                            <h5 class="text-wrap">Ciudad  -  <span class="fst-italic"> lat:    long:</span></h5>
                            <p class="text-wrap">Estado Actual: <span class="badge text-bg-secondary">NO DISPONIBLE</span></p>
                            <hr>
                            <div class="overflow-x-auto">

                            <table class="table table-striped table-responsive-sm">
                                <thead>
                                    <tr>
                                    <th scope="col">FECHA Y HORA</th>
                                    <th scope="col">TPM</th>
                                    <th scope="col">RH</th>
                                    <th scope="col">WS</th>
                                    <th scope="col">WD</th>
                                    <th scope="col">WG</th>
                                    <th scope="col">APCP</th>
                                    <th scope="col">CLOUD</th>
                                    <th scope="col">SLP</th>
                                    <th scope="col">ESTADO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <th scope="row">2023/xx/xx 03:00</th>
                                    <td>xx.x</td>
                                    <td>xx</td>
                                    <td>x</td>
                                    <td>xxxx</td>
                                    <td>x</td>
                                    <td>x.x</td>
                                    <td>xxx</td>
                                    <td>xx</td>
                                    <td><span class="badge text-bg-success">Verde</span></td>
                                    </tr>
                                    </tr>
                                </tbody>
                            </table>
                            </div>
                            </div>
                        </div>
                </div>
            </div>
            <!---->
                        

            <!---mapa-->
            <div class="mb-3">
            <button type="button" class="btn btn-success btn-block" data-bs-toggle="collapse" href="#mapa" role="button" aria-expanded="false" aria-controls="mapa">
            <i class="bi bi-map"></i> Mapa
            </button>   
            </div>

            <div class="collapse" id="mapa">
            <div class="container mb-3">
            <div class="col">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="ratio ratio-16x9">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d7599.294628885015!2d-73.06155361176158!3d-36.79191758152082!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2scl!4v1698161608468!5m2!1sen!2scl"  allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            </div>
            <!---->
                     <!---GLOSARIO-->
                     <br>
            <div class="container">
				<div class="mb-2">
					<div class="row" style="margin:0px;" id="diccionario">
							<div class="mb-2 col-auto">
								<h5><i class="bi bi-info-circle"></i> Estados de alerta</h5>
								<ul>
									<li><span class="badge text-bg-success">Verde</span> Operación Normal</li>
									<li><span class="badge text-bg-warning">Amarillo</span> Prevención</li>
									<li><span class="badge text-bg-danger">Roja</span> Incencio fuera de control - Recursos sobrepasados</li>
									<li><span class="badge text-bg-dark">Negra</span> Amenaza a CFI Y/o Sectores poblados</li>
								</ul>
							</div>
							<h5><i class="bi bi-book"></i> Diccionario Data:</h5>
							<div class="mb-3 col-auto">
								<ul>
								<li><b>TMP</b>: Temperatura, 2 metros sobre el suelo, unidades = Celsius.</li>
								<li><b>RH</b>: Humedad relativa, 2 metros sobre el suelo, unidades = Porcentaje.</li>
								<li><b>WS</b>: Velocidad del viento, a 10 metros sobre el suelo, unidades = km/h.</li>
								<li><b>WD</b>: Dirección del viento, 10 metros sobre el suelo, unidades = grados verdaderos.</li>
								<li><b>WG</b>: Ráfagas de viento, a 10 metros del suelo, unidades = km/h.</li>
								<li><b>APCP</b>: Precipitación acumulada, superficie, unidades = milímetros.</li>
								<li><b>CLOUD</b>: Cobertura de nubes, total en todos los niveles, unidades = Porcentaje de cielo cubierto.</li>
								<li><b>SLP</b>: Presión al nivel del mar, unidades = milibares.</li>
								<li><b>PTYPE</b>: Tipo de precipitación (RA = lluvia, SN = nieve, PL = hielo granulado, FZRA = lluvia helada).</li>
								<li><b>RQP</b>: Lluvia acumulada, superficie, unidades = milímetros.</li>
								<li><b>SQP</b>: Equivalente de agua de nieve acumulada, superficie, unidades = milímetros (NOTA: También equivale a nevadas aproximadas en centímetros. Es decir, 1 mm de equivalente de agua de nieve = 1 cm de nieve fresca, en promedio para una nevada reciente).</li>
								<li><b>FQP</b>: Lluvia helada acumulada, superficie, unidades = milímetros.</li>
								<li><b>IQP</b>: Granitos de hielo acumulados, superficie, unidades = milímetros.</li>
								<li><b>WS925</b>: Velocidad del viento, a 925 mb (aproximadamente 2500 pies sobre el nivel del mar), unidades = km/h.</li>
								<li><b>WD925</b>: Dirección del viento, a 925 mb, unidades = grados verdaderos.</li>
								<li><b>TMP850</b>: Temperatura, 850 mb, unidades = Celsius.</li>
								<li><b>WS850</b>: Velocidad del viento, a 850 mb (aproximadamente 5000 pies sobre el nivel del mar), unidades = km/h.</li>
								<li><b>WD850</b>: Dirección del viento, a 850 mb, unidades = grados verdaderos.</li>
								<li><b>4LFTX</b>: Mejor índice elevado de 4 capas, unidades = Celsius.</li>
								<li><b>HGT_0C_DB</b>: Nivel de congelación de bulbo seco, unidades = metros ASL.</li>
								<li><b>TMP_SFC</b>: Temperatura, superficie, unidades = Celsius.</li>
								<li><b>DSWRF</b>: Flujo de radiación de onda corta descendente, superficie, unidades = Watts/m^2.</li>
								<li><b>USWRF</b>: Flujo de radiación de onda corta ascendente, superficie, unidades = Watts/m^2.</li>
								<li><b>DLWRF</b>: Flujo de radiación de onda larga descendente, superficie, unidades = Watts/m^2.</li>
								<li><b>ULWRF</b>: Flujo de radiación de onda larga ascendente, superficie, unidades = Watts/m^2.</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
                </div>
         </div>
	</div>
</div>
</div>