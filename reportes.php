<?php 
	include("headers/header.php"); 
	session_start();
	if($_SESSION['permiso'] == 1  && $_SESSION['id_user']  != '') 
	{
?>
	<main id="mainlogin">
		<div class="row pnltabs">
		    <ul class="tabs tabsreporte">
		        <li class="tab col s2"><a class="mytexttabs" href="#repreguardatario">Reporte Resguardatario</a></li>
		        <li class="tab col s2"><a class="mytexttabs" href="#carresguardo">Carta de Resguardo</a></li>
		    </ul>
		</div>
		<div class="container pnlformulario tabsreportes">
			<div id="repreguardatario" class="row">
				<div class="row">
					<h5 class="mybluetext center">Reportes</h5>
				</div>
				<div class="row">
					<div class="col l4 m6 s12 input-field">
						<select id="cbxresguardatariorep">
						
						</select>
					</div>
					<div class="col l3 m6 s12 input-field">
						<input type="text" class="datepicker" name="txtfechaini" id="txtfechaini">
						<label for="txtfechaini">Fecha inicio</label>
					</div>
					<div class="col l3 m6 s12 input-field">
						<input type="text" class="datepicker" name="txtfechafin" id="txtfechafin">
						<label for="txtfechafin">Fecha fin</label>
					</div>
					<div class="col l2 m2 s12 center">
						<a id="btngenerarreporte" class="waves-effect waves-light btn-floating btn-large myblue tooltipped" data-position="right" data-delay="50" data-tooltip="Generar Reporte"><i class="material-icons">description</i></a>
					</div>
				</div>
				<div class="row pnltablesreportes">
					<div class="row">
						<div class="col l12 m12 s12">
							<h6 class="right" id="lblfecha">Fecha de reporte: </h6>
						</div>
					</div>
					<div class="row">
						<div class="col l4 m12 s12 center">
							<h6 id="lblresguardatario"></h6>
						</div>
						<div class="col l4 m6 s12 center">
							<h6 id="lbldireccion"></h6>
						</div>
						<div class="col l4 m6 s12 center">
							<h6 id="lbltotalregistros"></h6>
						</div>
					</div>
					<div class="col s12">
						<table id="tablereporteresguartario" class="bordered highlight centered responsive-table">
							<thead class="myblue white-text">
								<tr>
									<th>No.</th>
									<th>No. Prog</th>
									<th>Descripción</th>
									<th>Clave Cabms</th>
									<th>No. Serie</th>
									<th>No. Motor</th>
									<th>No. Pedido</th>
									<th>No. Alta</th>
									<th>Marca</th>
									<th>Modelo</th>
									<th>Costo</th>
								</tr>
							</thead>
							<tbody id="tbodyreportes">
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div id="carresguardo" class="row">
				<div class="row">
					<h5 class="mybluetext center">Carta de Resgurado</h5>
				</div>
				<div class="row">
					<div class="col l4 m6 s12 offset-l2">
						<select id="cbxresguardatariocar" onchange="pintaridresrep(this.value);">
						
						</select>
					</div>
					<form method="POST" action="Controllers/reports/generarcarta.php">
						<input type="hidden" name="txtid_resguardatariorep" id="txtid_resguardatariorep">
						<div class="col l4 m6 s12">
							<button class="waves-effect waves-light btn-floating btn-large myblue tooltipped" data-position="right" data-delay="50" data-tooltip="Generar Carta" id="btngenerarcarta"><i class="material-icons">description</i></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</main>
<?php 
		include("headers/footer.php");
	}
	else
	{
		header('location: index.php');
	}
?>
