<?php
session_start();
$ruta = 7;
$titulo = "Guías | CargoCaribe";
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>

<body class="hold-transition sidebar-mini">
	<div class="wrapper">
		<?php
		$page = "Guías";
		require_once $rutaLocal . "/includes/navbar.php";
		require_once $rutaLocal . "/includes/sidebar.php";
		?>

		<div class="content-wrapper py-3">
			<div class="content-header w-75 mx-auto">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-12">
							<h1 class="m-0"><?= $page ?></h1>
						</div>
						<input type="hidden" id="ciudadUser" value="<?= $_SESSION['caribecargo']['ciudad']; ?>">
						<div class="col-12 text-right">
							<a href="./index.php" class="btn btn-sm btn_primary"><i class="fa-solid fa-plus"></i> Nueva Guia</a>
							<button id="btnmodalCliente" class="btn btn-sm btn_primary"><i class="fa-solid fa-person-circle-plus"></i> Agregar Cliente</button>
							<button id="btnEtiquetas" class="btn btn-sm btn_primary" disabled><i class="fa-light fa-print"></i> Etiquetas</button>
							<button id="btnEtiquetasCopy" class="btn btn-sm btn_primary" disabled><i class="fa-light fa-print"></i> Etiquetas Copia</button>
							<button id="btnCarta" class="btn btn-sm btn_primary"><i class="fa-regular fa-floppy-disk-circle-arrow-right"></i> Capturar datos</button>
							<button id="btnCartaRes" class="btn btn-sm btn_primary"><i class="fa-regular fa-floppy-disk-circle-arrow-right"></i> Carta de responsabilidad</button>
							<button id="btnImprimirGuia" class="btn btn-sm btn_primary"><i class="fa-solid fa-print"></i> Imprimir Guia</button>
						</div>
					</div>
				</div>
			</div>

			<div class="container-fluid p-5 mx-auto">
				<div class="row">
					<div class="col-5 form-group">
						<label class="w-100">
							Ruta
							<select id="select_idruta" class="form-select">
								<option value="0" selected disabled>Seleccione una ruta...</option>
							</select>
							<input type="hidden" id="origen">
						</label>
					</div>
					<div class="col-4 form-group">
						<label class="w-100">
							# guia
							<input type="text" id="numGuia" class="form-control" value="BOG25005" disabled>
						</label>
					</div>
					<div class="col-3 form-group"><br>
						<label class="w-100">
							Comercial
							<input type="checkbox" id="comercialCheckbox">
						</label>
					</div>

					<div class="col-12 col-md-6 form-group">
						<label class="w-100">
							Remitente
							<select id="select_idremitente" class="form-select">
								<option value="0" selected disabled>Seleccione una remitente...</option>
							</select>
						</label>
					</div>
					<div class="col-12 col-md-5 form-group">
						<label class="w-100">
							Destinatario
							<select id="select_iddestinario" class="form-select">
								<option value="0" selected disabled>Seleccione una destinatario...</option>
							</select>
						</label>
					</div>

					<div class="col-12 form-group">
						<label class="w-100">
							Contenido
							<input type="text" id="contenido" class="form-control" placeholder="Especifique el contenido..." value="PRODUCTOS DE PRUEBA">
						</label>
					</div>
					<div class="col-12 form-group">
						<label class="w-100">
							Observaciones
							<textarea name="" id="observaciones" rows="3" class="form-control">ESTO ES UN CAMPO DE TEXTO</textarea>
						</label>
					</div>

					<div class="col-12 col-md-5 form-group">
						<label class="w-100">
							Producto
							<select id="select_idproducto" class="form-select">
								<option value="" selected disabled>Seleccione un producto...</option>
							</select>
						</label>
					</div>
					<div class="col-12 col-md-7 form-group">
						<div class="row">
							<div class="col-12 col-md-4">
								<label class="w-100">
									Piezas
									<input type="number" id="input_piezas" class="form-control" placeholder="Cantidad">
								</label>
							</div>
							<div class="col-12 col-md-4">
								<label class="w-100">
									Kilos
									<input type="number" id="input_kilos" class="form-control" placeholder="Kg">
								</label>
							</div>
							<div class="col-12 col-md-4">
								<label class="w-100">
									Volumen
									<input type="number" id="input_volumen" class="form-control" placeholder="Vol">
								</label>
							</div>

						</div>
					</div>
					<div class="col-12 col-md-12 form-group " style="background-color: #E6E6E6;" id="productosEspeciales">

					</div>
					<div class="col-12 col-md-4 form-group">
						<label class="w-100">
							Método de pago
							<select id="select_idmetodopago" class="form-select">
								<option value="" selected disabled>Seleccione un método de pago...</option>
								<option value="1">NO UTILIZAR</option>
								<option value="2">CHEQUE</option>
								<option value="3">CONSIGNACION</option>
								<option value="3">TRASNFERENCIA</option>
								<option value="3">CREDITO</option>
							</select>
						</label>
						<label class="w-100 text-secondary text-right">
							<input id="pagaRemitenteCheck" type="checkbox" value="1">
							Paga remitente
						</label>
					</div>
					<div class="col-12 col-md-4">
						<label class="w-100">
							Flete
							<input type="number" id="input_flete" class="form-control" placeholder="$">
						</label>
					</div>
					<div class="col-12 col-md-4">
						<label class="w-100">
							Val. declarado
							<input type="number" id="valDeclarado" class="form-control" placeholder="$">
						</label>
					</div>

					<div class="col-12 col-md-4">
						<label class="w-100">
							% Seguro
							<input type="number" id="seguroG" class="form-control" placeholder="%">
						</label>
					</div>
					<div class="col-12 col-md-4 form-group">
						<label class="w-100">
							Tarifa Combustible
							<input id="tarifaCombustible" type="number" class="form-control" placeholder="$">
						</label>
					</div>
					<div class="col-12 col-md-4 form-group">
						<label class="w-100">
							Valuación
							<input id="valuacion" type="number" class="form-control" placeholder="$">
						</label>
					</div>

					<hr class="mb-2">


					<div class="col-12 col-md-4">
						<label class="w-100">
							Val. Seguro
							<input type="number" id="valSeguro" class="form-control border_primary" placeholder="$">
						</label>
					</div>
					<div class="col-12 col-md-4">
						<label class="w-100">
							Val. Envío
							<input type="number" id="valEnvio" class="form-control border_primary" placeholder="$">
						</label>
					</div>
					<div class="col-12 col-md-4 form-group">
						<label class="w-100">
							Valor Combustible
							<input type="number" id="valorCombustible" class="form-control border_primary" placeholder="$">
						</label>
					</div>
					<div class="row" id="adicionales">
						<div class="col-12 col-md-3 form-group">
							<label class="w-100">
								Domicilio
								<input type="number" id="aditionalDomicilio" class="form-control aditionals" placeholder="$" value="0">
							</label>
						</div>
						<div class="col-12 col-md-3 form-group">
							<label class="w-100">
								Embalajes
								<input type="number" id="aditionalEmbalaje" class="form-control aditionals" placeholder="$" value="0">
							</label>
						</div>
						<div class="col-12 col-md-3 form-group">
							<label class="w-100">
								Recogida
								<input type="number" id="aditionalRecogida" class="form-control aditionals" placeholder="$" value="0">
							</label>
						</div>
						<div class="col-12 col-md-3 form-group">
							<label class="w-100">
								Huacales
								<input type="number" id="aditionalHuacales" class="form-control aditionals" placeholder="$" value="0">
							</label>
						</div>
						<div class="col-12 col-md-3 form-group">
							<label class="w-100">
								Shiper
								<input type="number" id="aditionalShiper" class="form-control aditionals" placeholder="$" value="0">
							</label>
						</div>
						<div class="col-12 col-md-3 form-group">
							<label class="w-100">
								Mercancia peligrosa
								<input type="number" id="aditionalPeligrosa" class="form-control aditionals" placeholder="$" value="0">
							</label>
						</div>
						<div class="col-12 col-md-3 form-group">
							<label class="w-100">
								Otros
								<input type="number" id="aditionalOtros" class="form-control aditionals" placeholder="$" value="0">
							</label>
						</div>
					</div>

					<div class="col-12 col-md-6 form-group bg-white py-2">
						<button id="btnAdicionales" class="btn btn-sm btn_primary"><i class="fa-sharp fa-solid fa-cart-plus"></i> Gastos Adicionales</button>
						<button id="btnGuadaCambios" class="btn btn-sm btn_primary"><i class="fa-regular fa-floppy-disk-circle-arrow-right"></i> Guardar cambios</button>
					</div>
					<div class="col-12 col-md-6 form-group border border-danger rounded-2 bg-white py-2">
						<label class="w-100">
							TOTAL
							<input id="valorTotal" type="number" class="form-control text-danger fw-bolder" value="$0.0" readonly>
						</label>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- modal Carta Responsabilidad -->
	<!-- ModalCrear -->
	<div class="modal fade" id="modalCartaResponsabilidad" tabindex="-1" role="dialog" aria-labelledby="modalCartaResponsabilidadLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title fw-bolder" id="modalCartaResponsabilidadLabel"><i class="fas fa-map text-secondary"></i> Carta de responsabilidad</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<span class="small mx-3">cuenta con huellero digital? </span><input type="checkbox" name="hayHuellero" id="hayHuellero">
					<hr>
					<div class="row">
						<div class="col-7">
							<span>Foto:</span>
							<button id="btnCapturar" class="btn btn_primary btn-sm"><i class="fa-solid fa-camera"></i></button>
							<button class="btn btn_primary btn-sm" id="btnActivarDesactivar"><i class="fa-solid fa-toggle-on"></i></button>
							<div id="camara-container">
								<video id="camara-preview" style="max-width: 100%; border: 2px solid red;" autoplay></video>
								<img id="imagen-preview" style="max-width: 100%; border: 2px solid blue;" src="../../temp_data/fotos/default.png" alt="Imagen de muestra">
								<canvas id="canvas-foto" style="display: none;"></canvas>
							</div>
						</div>
						<div class="col-5">
							<span>Huella: </span>
							<button class="btn btn-sm btn_primary" id="btnValidarHuella">Validar si Existe</button>
							<img id="imagen-huella" style="max-width: 100%;" src="../../temp_data/fotos/default.png" alt="Imagen de muestra" class="img-fluid border border-black">
						</div>
						<hr>
						<div class="col-12">
							<span>Cedulas: </span>
						</div>
						<div class="col-6 p-3">
							<img src="../../temp_data/cedulas/default1.jpg" alt="" id="cedula1" class="img-fluid">
						</div>
						<div class="col-6 p-3">
							<img src="../../temp_data/cedulas/default2.jpg" alt="" id="cedula2" class="img-fluid">
						</div>
						<div class="col-12">

						</div>
					</div>
					<button type="button" id="btnGuardarImg" class="btn btn-primary">Capturar Datos</button>
				</div>
				<div class="modal-footer">
				</div>
			</div>
		</div>
	</div>
	<!-- fin modal -->
	<div id="divEtiquetas">
	</div>

	<?php
	require_once $rutaLocal . "/views/tablas/clientes/modalAddClients.php";
	require_once $rutaLocal . "/includes/scripts.php"; ?>
	<script src="/js/functions_guias.js"></script>
	<script src="/js/functions_guias_foto.js"></script>
	<script src="/js/functions_guias_productos.js"></script>
</body>