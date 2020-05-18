<?php 
	include("headers/header.php");
	session_start();
	if($_SESSION['permiso'] == 1  && $_SESSION['id_user']  != '') 
	{
?>
	<main id="mainlogin">
		<div class="row pnltabs">
		    <ul class="tabs tabsuser">
		        <li class="tab col s2"><a class="mytexttabs" href="#adduser">Añadir Usuario</a></li>
		        <li class="tab col s2"><a class="mytexttabs" href="#seeuser">Consultar Usuario</a></li>
		    </ul>
		</div>
		<div class="container pnlformulario">	
			<div id="adduser" class="row">
				<div class="row">
					<h5 class="mybluetext center">Registrar Usuario</h5>
				</div>
				<div class="row">
					<div class="col l4 m6 s12 input-field">
						<input type="text" name="nombre" id="nombre" class="validate" autocomplete="off">
						<label for="nombre">Nombre</label>
					</div>
					<div class="col l4 m6 s12 input-field">
						<input type="text" name="apellidos" id="apellidos" class="validate" autocomplete="off">
						<label for="apellidos">Apellidos</label>
					</div>
					<div class="col l4 m6 s12 input-field">
						<input type="text" name="email" id="email" class="validate" autocomplete="off">
						<label for="email">Email</label>
					</div>
					<div class="col l4 m6 s12 input-field">
						<input type="text" name="user" id="user" class="validate" autocomplete="off">
						<label for="user">Usuario</label>
					</div>
					<div class="col l4 m6 s12 input-field">
						<input type="password" name="password" id="password" class="validate" autocomplete="off">
						<label for="password">Contraseña</label>
					</div>
					<div class="col l4 m6 s12 input-field">
						<input type="password" name="reppass" id="reppass" class="validate" autocomplete="off">
						<label for="reppass">Repetir contraseña</label>
					</div>
				</div>	
				<div class="row">
					<h5 class="mybluetext center" id="mensajeadd"></h5>
				</div>
				<div class="row center">
					<a class="waves-effect waves-light btn myblue" id="btnregistraruser">Registrar</a>
				</div>
			</div>
			<div id="seeuser" class="row">
				<div class="row">
					<h5 class="mybluetext center">Consultar Usuarios</h5>
				</div>
				<div class="row">
					<div class="col l6 m8 s10 offset-l2 offset-m1 input-field">
						<input type="text" name="txtnombus" id="txtnombus" class="validate">
						<label for="txtnombus">Ingrese Nombre</label>
					</div>
					<div class="col l2 m2 s2 input-field">
						<a id="btnbuscarnomuser"class="btn-floating btn waves-effect waves-light myblue mybtnfloating tooltipped" data-position="right" data-delay="50" data-tooltip="Buscar"><i class="material-icons">search</i></a>
					</div>
				</div>
				<div class="row">
					<div class="col l12 m12 s12">
						<table class="bordered responsive-table highlight centered">
							<thead class="grey white-text">
								<tr>
									<th>No</th>
									<th>Nombre</th>
									<th>Email</th>
									<th>Usuario</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody id="tbodyusers">
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>		
	</main>
	<section>
		<div id="actualizardatos" class="modal mymodal">
		    <div class="modal-content">
		    	<div class="row">
			      	<h4 class="center mybluetext">Actualizar Datos</h4>
			    </div>
			    <div class="row">
			    	<div class="col s12 input-field">
			    		<input type="text" name="txtnombreact" id="txtnombreact" class="validate">
			    		<label for="txtnombreact">Nombre</label>
			    	</div>
			    	<div class="col s12 input-field">
			    		<input type="text" name="txtapellidosact" id="txtapellidosact" class="validate">
			    		<label for="txtapellidosact">Apellido</label>
			    	</div>
			    	<div class="col s12 input-field">
			    		<input type="text" name="txtemailact" id="txtemailact" class="validate">
			    		<label for="txtemailact">Email</label>
			    	</div>
			    	<input type="hidden" name="txtiduser" id="txtiduser">
			    	<div class="col s12 center">
			    		<h5 class="mybluetext" id="mensajeupd"></h5>
			    	</div>
			    	<div class="col s12 center">
			    		<a class="waves-effect waves-light btn myblue" id="btnactualizarruser">Actualizar Datos</a>
			    	</div>
			    </div>
		    </div>
		    <div class="modal-footer">
		      <a href="#!" class="modal-action modal-close waves-effect btn-flat">Cerrar</a>
		    </div>
		</div>
	</section>
	<section>
		<div id="eliminarrdatos" class="modal mymodal">
		    <div class="modal-content">
		    	<div class="row">
			      	<h5 class="mybluetext">¿Desea eliminar usario?</h5>
			    </div>
			    <div class="row center">
			      	<h5 class="mybluetext" id="mensajedel"></h5>
			    </div>
			    <input type="hidden" name="txtiduserdel" id="txtiduserdel">
		    </div>
		    <div class="modal-footer">
		      <a id="btneliminaruser"  href="#!" class="waves-effect btn-flat">SI</a>
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