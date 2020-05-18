<?php 
	include("headers/header.php");

	session_start();
	if($_SESSION['permiso'] == 1  && $_SESSION['id_user']  != '') 
	{
?>
	<main id="mainlogin">
		<div class="row pnltabs">
		    <ul class="tabs tabsactivo">
		        <li class="tab col s2"><a class="mytexttabs" href="#addactivo">Añadir Activo</a></li>
		        <li class="tab col s2"><a class="mytexttabs" href="#seeactivo">Consultar Activo</a></li>
		    </ul>
		</div>
		<div class="container pnlformulario">
			<div id="addactivo" class="row">
				<div class="row">
					<h5 class="mybluetext center">Registrar Activo</h5>
				</div>
				<div class="row">
					<div class="col l4 m6 s12 input-field">
						<input type="number" name="txtnumprog" id="txtnumprog" class="validate">
						<label for="txtnumprog">Número Progresivo</label>
					</div>
					<div class="col l4 m6 s12 input-field">
						<input type="text" name="txtclavecambs" id="txtclavecambs" class="validate">
						<label for="txtclavecambs">Clave Cambs</label>
					</div>
					<div class="col l4 m6 s12 input-field">
						<input type="text" name="txtnoserie" id="txtnoserie" class="validate">
						<label for="txtnoserie">Número de Serie</label>
					</div>
					<div class="col l8 m12 s12 input-field">
						<input type="text" name="txtdescripcion" id="txtdescripcion" class="validate">
						<label for="txtdescripcion">Descripción</label>
					</div>
					<div class="col l4 m6 s12 input-field">
						<input type="text" name="txtmarca" id="txtmarca" class="validate">
						<label for="txtmarca">Marca</label>
					</div>
					<div class="col l4 m6 s12 input-field">
						<input type="text" name="txtmodelo" id="txtmodelo" class="validate">
						<label for="txtmodelo">Modelo</label>
					</div>
					<div class="col l4 m6 s12 input-field">
						<input type="text" name="txtnummotor" id="txtnummotor" class="validate">
						<label for="txtnummotor">Número de motor</label>
					</div>
					<div class="col l4 m6 s12 input-field">
						<input type="text" name="txtcosto" id="txtcosto" class="validate">
						<label for="txtcosto">Costo</label>
					</div>
					<div class="col l4 m6 s12 input-field">
						<input type="text" name="txtnopedido" id="txtnopedido" class="validate">
						<label for="txtnopedido">Número de Pedido</label>
					</div>
					<div class="col l4 m6 s12 input-field">
						<input type="text" name="txtnumalta" id="txtnumalta" maxlength="10" class="validate">
						<label for="txtnumalta">Número de Alta</label>
					</div>
					<div class="col l4 m6 s12 input-field">
						<input type="text" name="txtaalta" id="txtaalta" maxlength="5" class="validate">
						<label for="txtaalta">A Alta</label>
					</div>
					<div class="col l4 m6 s12 input-field">
						<select id="resguardatario">
							
						</select>
					</div>
				</div>
				<div class="row center">
					<h5 class="mybluetext" id="mensajeadd"></h5>
				</div>
				<div class="row center">
					<a class="waves-effect waves-light btn myblue" id="btnregistraractivo">Registrar</a>
				</div>
			</div>
			<div id="seeactivo" class="row">
				<div class="row">
					<div class="col l3 m6 s12 offset-l1 input-field">
						<input type="text" name="txtbusresguardatario" id="txtbusresguardatario" class="validate">
						<label for="txtbusresguardatario">Nombre del Resguardatario</label>
					</div>
					<div class="col l3 m6 s12 input-field">
						<input type="text" name="txtbusnumprog" id="txtbusnumprog" class="validate">
						<label for="txtbusnumprog">Número Progresivo</label>
					</div>
					<div class="col l3 m6 s12 input-field">
						<input type="text" name="txtbusclave" id="txtbusclave" class="validate">
						<label for="txtbusnumprog">Clave Cambs</label>
					</div>
					<div class="col l1 m1 s1 input-field" input-field>
						<a id="btnbuscaractivo"class="btn-floating btn waves-effect waves-light myblue mybtnfloating tooltipped" data-position="right" data-delay="50" data-tooltip="Buscar"><i class="material-icons">search</i></a>
					</div>
				</div>
				<div class="row">
					<div class="col s12">
						<table class="bordered centered highlight responsive-table">
							<thead class="grey white-text">
								<tr>
									<th>No</th>
									<th>Num Prog</th>
									<th>Clave Cambs</th>
									<th>Número de Alta</th>
									<th>A de Alta</th>
									<th>Resguardatario</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody id="tbodyactivo">
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</main>
	<section>
		<div id="eliminarrdatosactivo" class="modal mymodal">
		    <div class="modal-content">
		    	<div class="row">
			      	<h5 class="mybluetext">¿Desea eliminar resguardatario?</h5>
			    </div>
			    <div class="row center">
			    	<h5 class="mybluetext" id="mensajedel"></h5>
			    </div>
			    <input type="hidden" name="txtidactivoeli" id="txtidactivoeli">
		    </div>
		    <div class="modal-footer">
		      <a href="#!" id="btneliminaractivo" class="waves-effect btn-flat">SI</a>
		      <a href="#!" class="modal-action modal-close waves-effect btn-flat">Cerrar</a>
		    </div>
		</div>
	</section>
	<section>
		<div id="actualizardatosactivo" class="modal mymodal">
		    <div class="modal-content">
		    	<div class="row">
			      	<h4 class="center mybluetext">Actualizar Datos</h4>
			    </div>
			    <div class="row">
			    	<div class="col l12 m12 s12 input-field">
			    		<input type="text" name="txtdescripcionact" id="txtdescripcionact" class="validate">
			    		<label for="txtdescripcionact">Descripción</label>
			    	</div>
			    	<div class="col l12 m12 s12 input-field">
			    		<input type="text" name="txtnoseriact" id="txtnoseriact" class="validate">
			    		<label for="txtnoseriact">Número de Serie</label>
			    	</div>
			    	<div class="col l6 m6 s12 input-field">
			    		<input type="text" name="txtmarcaact" id="txtmarcaact" class="validate">
			    		<label for="txtmarcaact">Marca</label>
			    	</div>
			    	<div class="col l6 m6 s12 input-field">
			    		<input type="text" name="txtmodeloact" id="txtmodeloact" class="validate">
			    		<label for="txtmodelo">Modelo</label>
			    	</div>
			    	<div class="col l6 m6 s12 input-field">
			    		<input type="text" name="txtnomotorsact" id="txtnomotorsact" class="validate">
			    		<label for="txtnomotorsact">Número de motor</label>
			    	</div>
			    	<div class="col l6 m6 s12 input-field">
			    		<input type="text" name="txtcostosact" id="txtcostosact" class="validate">
			    		<label for="txtcostosact">Costo</label>
			    	</div>
			    	<div class="col l12 m12 s12 input-field">
			    		<select id="cbxresguardatarioact">

			    		</select>
			    	</div>
			    	<input type="hidden" name="txtidactivoact" id="txtidactivoact">
			    	<input type="hidden" name="txtidcategoriaact" id="txtidcategoriaact">
			    	<div class="col s12 center">
			    		<h5 class="mybluetext" id="mensajeupd"></h5>
			    	</div>
			    	<div class="col s12 center">
			    		<a class="waves-effect waves-light btn myblue" id="btnactualizaractivo">Actualizar Datos</a>
			    	</div>
			    </div>
		    </div>
		    <div class="modal-footer">
		      <a href="#!" class="modal-action modal-close waves-effect btn-flat">Cerrar</a>
		    </div>
		</div>
	</section>
	<section>
		<div id="detalleactivo" class="modal mymodallarge">
		    <div class="modal-content">
		    	<div class="row">
			      	<h4 class="center mybluetext">Detalle Inventario</h4>
			    </div>
			    <div class="row">
			    	<table>
			    		<thead class="myblue white-text">
			    			<tr>
			    				<th>Descripción</th>
			    				<th>No. de serie</th>
			    				<th>Marca</th>
			    				<th>Modelo</th>
			    				<th>No. de motor</th>
			    				<th>No. de pedido</th>
			    				<th>Costo</th>
			    			</tr>
			    		</thead>
			    		<tbody id="tbodydetalleactivo">

			    		</tbody>
			    	</table>
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
