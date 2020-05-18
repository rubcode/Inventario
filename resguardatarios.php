<?php 
	include("headers/header.php");
	session_start();
	if($_SESSION['permiso'] == 1  && $_SESSION['id_user']  != '') 
	{
?>
	<main id="mainlogin">
		<div class="row pnltabs">
		    <ul class="tabs tabsresguardatario">
		        <li class="tab col s2"><a class="mytexttabs" href="#addresguardatario">Añadir Resguardatario</a></li>
		        <li class="tab col s2"><a class="mytexttabs" href="#seeresguardatario">Consultar Resguardatarios</a></li>
		    </ul>
		</div>
		<div class="container pnlformulario">
			<div id="addresguardatario" class="row">
				<div class="row">
					<h5 class="mybluetext center">Registrar Reguardatario</h5>
				</div>
				<div class="row">
					<div class="col l4 m6 s12 input-field">
						<input type="text" name="txtnombreres" id="txtnombreres" class="validate">
						<label for="txtnombreres">Nombre</label>
					</div>
					<div class="col l4 m6 s12 input-field">
						<input type="text" name="txtapellidores" id="txtapellidores" class="validate">
						<label for="txtapellidores">Apellidos</label>
					</div>
					<div class="col l4 m6 s12 input-field">
						<input type="text" name="txtrfcres" id="txtrfcres" maxlength="15" class="validate">
						<label for="txtrfcres">RFC</label>
					</div>
					<div class="col l4 m6 s12 input-field">
						<input type="text" name="txttitulores" id="txttitulores" maxlength="5"  class="validate">
						<label for="txttitulores">Título</label>
					</div>
					<div class="col l4 m6 s12 input-field">
						<input type="text" name="txtcargores" id="txtcargores"  class="validate">
						<label for="txtcargores">Cargo</label>
					</div>
					<div class="col l4 m6 s12 input-field">
						<select id="direccion">

						</select>
					</div>
					<div class="col l4 m6 s12 input-field">
						<input type="text" name="txtemailres" id="txtemailres"  class="validate">
						<label for="txtemailres">Email</label>
					</div>
					<div class="col l4 m6 s12 input-field">
						<input type="text" name="txtextensionres" id="txtextensionres" max="11" class="validate">
						<label for="txtextensionres">Télefono</label>
					</div>
				</div>
				<div class="row center">
					<h5 class="mybluetext center" id="mensajeadd"></h5>
				</div>
				<div class="row center">
					<a class="waves-effect waves-light btn myblue" id="btnregistrarresguardatario">Registrar resguardatario</a>
				</div>
			</div>
			<div id="seeresguardatario" class="row">
				<div class="row">
					<h5 class="mybluetext center">Consultar Reguardatario</h5>
				</div>
				<div class="row">
					<div class="col l6 m8 s10 offset-l2 offset-m1 input-field">
						<input type="text" name="txtnombrebusres" id="txtnombrebusres" class="validate">
						<label for="txtnombrebus">Nombre</label>
					</div>
					<div class="col l2 m2 s1 input-field">
						<a id="btnbuscarnomreguardatario" class="btn-floating btn waves-effect waves-light myblue mybtnfloating tooltipped" data-position="right" data-delay="50" data-tooltip="Buscar"><i class="material-icons">search</i></a>
					</div>
				</div>
				<div class="row">
					<div class="col s12">
						<table class="bordered centered highlight responsive-table">
							<thead class="grey white-text">
								<tr>
									<th>No</th>
									<th>Nombre</th>
									<th>RFC</th>
									<th>Título</th>
									<th>Cargo</th>
									<th>Dirección</th>
									<th>Extensión</th>
									<th>Email</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody id="tbodyreguardatarios">
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</main>
	<section>
		<div id="actualizardatosres" class="modal mymodal">
		    <div class="modal-content">
		    	<div class="row">
			      	<h5 class="center mybluetext">Actualizar Datos</h5>
			    </div>
			    <div class="row">
			    	<div class="col l6 m6 s12 input-field">
			    		<input type="text" name="txtnombreresact" id="txtnombreresact" class="validate">
			    		<label for="txtnombreresact">Nombre</label>
			    	</div>
			    	<div class="col l6 m6 s12 input-field">
			    		<input type="text" name="txtapellidosresact" id="txtapellidosresact" class="validate">
			    		<label for="txtapellidosresact">Apellido</label>
			    	</div>
			    	<div class="col l12 m12 s12 input-field">
			    		<input type="text" name="txtrfcresact" id="txtrfcresact" class="validate">
			    		<label for="txtrfcresact">RFC</label>
			    	</div>
			    	<div class="col l6 m6 s12 input-field">
			    		<input type="text" name="txttituloresact" id="txttituloresact" class="validate">
			    		<label for="txttituloresact">Título</label>
			    	</div>
			    	<div class="col l6 m6 s12 input-field">
			    		<input type="text" name="txtcargoresact" id="txtcargoresact" class="validate">
			    		<label for="txtcargoresact">Cargo</label>
			    	</div>
			    	<div class="col l12 m12 s12 input-field">
			    		<select id="cbxdireccionresact">
							<option value="" disabled selected>Seleccione dirección</option>
							<option value="1">Direccion 1</option>
							<option value="2">Direccion 2</option>
						</select>
			    	</div>
			    	<div class="col l6 m6 s12 input-field">
			    		<input type="text" name="txtextensionresact" id="txtextensionresact" class="validate">
			    		<label for="txtextensionresact">Extensión</label>
			    	</div>
			    	<div class="col l6 m6 s12 input-field">
			    		<input type="text" name="txtemailresact" id="txtemailresact" class="validate">
			    		<label for="txtemailresact">Email</label>
			    	</div>
			    	<input type="hidden" name="txtidresg" id="txtidresg">
			    	<div class="col s12 center">
			    		<h5 class="mybluetext" id="mensajeupd"></h5>
			    	</div>
			    	<div class="col s12 center">
			    		<a class="waves-effect waves-light btn myblue" id="btnactualizarresguardatario">Actualizar Datos</a>
			    	</div>
			    </div>
		    </div>
		    <div class="modal-footer">
		      <a href="#!" class="modal-action modal-close waves-effect btn-flat">Cerrar</a>
		    </div>
		</div>
	</section>
	<section>
		<div id="eliminarrdatosres" class="modal mymodal">
		    <div class="modal-content">
		    	<div class="row">
			      	<h5 class="mybluetext">¿Desea eliminar resguardatario?</h5>
			    </div>
			    <div class="row center">
			      	<h5 class="mybluetext" id="mensajedel"></h5>
			    </div>
			    <input type="hidden" name="txtidresgeli" id="txtidresgeli">
		    </div>
		    <div class="modal-footer">
		      <a href="#!" id="btneliresguardatario" class=" waves-effect btn-flat">SI</a>
		      <a href="#!" class="modal-action modal-close waves-effect btn-flat">Cerrar</a>
		    </div>
		</div>
	</section>
	<section>
		<div id="cambiarresguardatario" class="modal mymodallarge">
		    <div class="modal-content">
		    	<div class="row">
			      	<h5 class="center mybluetext">Cambio Resguardatario</h5>
			    </div>
			    <div class="row">
			    	<select id="cbxresguardatarioact">

			    	</select>
			    </div>
			    <div class="row">
			    	<h6 class="center mybluetext">Lista de Activo</h6>
			    </div>
			    <div class="row pnlactivos">
			    	
			    </div>
			    <div class="row center">
			    	<h5 class="mybluetext" id="mensajecam"></h5>
			    </div>
			    <div class="row center">
			    	<a class="waves-effect waves-light btn myblue" id="btncambiarreguardatario">Cambiar Reguardatario</a>
			    </div>
		    </div>
		    <div class="modal-footer">
		      <a href="#!" class="modal-action modal-close waves-effect btn-flat">Cerrar</a>
		    </div>
		</div>
	</section>
<?php 
		include("headers/footer.php");
	}
	else
	{
		header('location: index.php');
	}
?>
