$(document).ready(function(){

	//Dar de alta Usuario
	$("#btnregistraruser").click(function(){
		var nombre = $("#nombre").val();
		var apellido = $("#apellidos").val();
		var email = $("#email").val();
		var user = $("#user").val();
		var password = $("#password").val();
		var repetir = $("#reppass").val();
		var emailtest = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;

		if(nombre != "" && apellido != "" && email != "" && user != "" && password != "" && repetir != "")
		{
			if(emailtest.test(email))
			{
				if(password == repetir)
				{
					$.ajax({
						url: 'Controllers/users/adduser.php',
						method: 'POST',
						data: {nombre: nombre,apellido:apellido,email:email,user:user,password:password},
						success: function(msg){
							if(msg == "0")
							{
								$("#mensajeadd").text("El usuario ya existe en la base de datos");
								$("#mensajeadd").addClass("red-text");
								$("#mensajeadd").removeClass("mybluetext");
								$("#user").val("");
								$("#user").focus();
								$("#mensajeadd").fadeIn(2000,function(){
									$("#mensajeadd").fadeOut(3000);
								});
							}
							else if(msg == "1")
							{
								$("#mensajeadd").text("Usuario ingresado correctamente");
								$("#mensajeadd").removeClass("red-text");
								$("#mensajeadd").fadeIn(2000,function(){
									$("#mensajeadd").fadeOut(3000);
								});
								$("#nombre").val("");
								$("#apellidos").val("");
								$("#email").val("");
								$("#user").val("");
								$("#password").val("");
								$("#reppass").val("");
								$("label").removeClass("active");
								$("input").removeClass("valid");
								mostrarusuario("");	
							}
							else
							{
								alert(msg);
							}
							
						}					
					});
				}
				else
				{
					$("#mensajeadd").text("Las contraseñas con coinciden");
					$("#mensajeadd").addClass("red-text");
					$("#mensajeadd").removeClass("mybluetext");
					$("#reppass").val("");
					$("#reppass").focus();
					$("#mensajeadd").fadeIn(2000,function(){
						$("#mensajeadd").fadeOut(3000);
					});
				}
			}
			else
			{
				$("#mensajeadd").text("El correo ingresado no tiene el formato correcto");
				$("#mensajeadd").addClass("red-text");
				$("#mensajeadd").removeClass("mybluetext");
				$("#email").val("");
				$("#email").focus();
				$("#mensajeadd").fadeIn(2000,function(){
					$("#mensajeadd").fadeOut(3000);
				});
			}
		}
		else
		{
			$("#mensajeadd").text("Debe ingresar todos los campos para continuar");
			$("#mensajeadd").addClass("red-text");
			$("#mensajeadd").removeClass("mybluetext");
			$("#mensajeadd").fadeIn(2000,function(){
				$("#mensajeadd").fadeOut(3000);
			});
		}
	});

	//Login
	$("#ingresarlogin").click(function(){
		var user = $("#user").val();
		var password = $("#pass").val();

		if(user != "" && password != "")
		{
			$.ajax({
				url: 'Controllers/users/login.php',
				method: 'POST',
				data: {user:user,password:password},
				success: function(msg){
					if(msg == "-1")
					{
						$("#mensaje").addClass("red-text");
						$("#mensaje").removeClass("mybluetext");
						$("#mensaje").text("Usuario y/o contraseña incorrectos");
						$("#mensaje").fadeIn(3000,function(){
							$("#mensaje").fadeOut(3000);
						});
					}
					else
					{
						window.location = msg;
					}
				}					
			});
		}
		else
		{
			$("#mensaje").addClass("red-text");
			$("#mensaje").removeClass("mybluetext");
			$("#mensaje").text("Debe ingresar usuario y contraseña");
			$("#mensaje").fadeIn(3000,function(){
				$("#mensaje").fadeOut(3000);
			});

		}
	});
	//Actualizar datos usuario
	$('#btnactualizarruser').click(function(){
		var nombre = $("#txtnombreact").val();
		var apellido = $("#txtapellidosact").val();
		var email = $("#txtemailact").val();
		var id = $("#txtiduser").val();
		var emailtest = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;

		if(nombre != "" && apellido != "" && email != "" && id != "")
		{
			if(emailtest.test(email))
			{
				$.ajax({
					url: 'Controllers/users/updateuser.php',
					method: 'POST',
					data: {nombre:nombre,apellido:apellido,email:email,id:id},
					success: function(msg){
						if(msg == "1")
						{
							$("#mensajeupd").text("Usuario actualizado correctamente");
							$("#mensajeupd").removeClass("red-text");
							$("#mensajeupd").fadeIn(2000,function(){
								$("#mensajeupd").fadeOut(3000,function(){
									mostrarusuario("");
								});
							});

						}
						else
						{
							alert(msg);
						}
					}					
				});
			}
			else
			{
				$("#mensajeupd").text("El correo ingresado no tiene el formato correcto");
				$("#mensajeupd").addClass("red-text");
				$("#mensajeupd").removeClass("mybluetext");
				$("#txtemailact").val("");
				$("#txtemailact").focus();
				$("#mensajeupd").fadeIn(2000,function(){
					$("#mensajeupd").fadeOut(3000);
				});
			}
		}
		else
		{
			$("#mensajeupd").addClass("red-text");
			$("#mensajeupd").removeClass("mybluetext");
			$("#mensajeupd").text("Debe ingresar todos los campos");
			$("#mensajeupd").fadeIn(3000,function(){
				$("#mensajeupd").fadeOut(3000);
			});
		}
	});

	//Dar de baja usuario
	$("#btneliminaruser").click(function(){
		var id = $("#txtiduserdel").val();

		if(id != "")
		{
			$.ajax({
				url: 'Controllers/users/deleteuser.php',
				method: 'POST',
				data: {id:id},
				success: function(msg){
					if(msg == "1")
					{
						$("#mensajedel").text("Usuario eliminado correctamente");
						$("#mensajedel").removeClass("red-text");
						$("#mensajedel").fadeIn(2000,function(){
							$("#mensajedel").fadeOut(3000,function(){
								mostrarusuario("");
							});
						});
					}
					else
					{
						alert(msg);
					}
				}					
			});
		}
	});

	//Buscar archivo
	$("#btnbuscarnomuser").click(function(){
		var nombre = $("#txtnombus").val();

		if(nombre != "")
		{
			mostrarusuario(nombre);
		}
		else
		{
			Material.toast("Ingrese nombre a buscar",3000,"rounded");
		}
	});
	//Mando a llamar la funcion que llena la tabla de usuarios
	mostrarusuario("");

	/**********************************RESGUARDATARIO**********************************/

	//Lleno combobox resguardatario
	llenarcombodirecciones();
	llenarcomboresguadartario();

	//Registrar resguardatario

	$("#btnregistrarresguardatario").click(function(){
		var nombre = $("#txtnombreres").val(); 
		var apellido = $("#txtapellidores").val();
		var titulo = $("#txttitulores").val(); 
		var cargo = $("#txtcargores").val();
		var direccion = $("#direccion").val(); 
		var extension = $("#txtextensionres").val();
		var email = $("#txtemailres").val();
		var rfc = $("#txtrfcres").val();
		var emailtest = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;

		if(nombre != "" && apellido != "" && titulo != "" && cargo != "" && direccion != "" && extension != "" && email != "" && rfc != "")
		{
			if(emailtest.test(email))
			{
				$.ajax({
						url: 'Controllers/resguardatario/addresguardatario.php',
						method: 'POST',
						data: {nombre: nombre,apellido:apellido,titulo:titulo,cargo:cargo,direccion:direccion,extension:extension,email:email,rfc:rfc},
						success: function(msg){
							if(msg == "1")
							{
								$("#mensajeadd").text("Reguardatario ingresado correctamente");
								$("#mensajeadd").removeClass("red-text");
								$("#mensajeadd").fadeIn(2000,function(){
									$("#mensajeadd").fadeOut(3000);
								});
								$("#txtnombreres").val("");
								$("#txtapellidores").val("");
								$("#txttitulores").val("");
								$("#txtcargores").val("");
								$("#direccion").val("");
								$("#txtextensionres").val("");
								$("#txtemailres").val("");
								$("#txtrfcres").val("");
								$("label").removeClass("active");
								$("input").removeClass("valid");
							}
							else
							{
								alert(msg);
							}
							
						}					
				});
			}
			else
			{
				$("#mensajeadd").text("El correo ingresado no tiene el formato correcto");
				$("#mensajeadd").addClass("red-text");
				$("#mensajeadd").removeClass("mybluetext");
				$("#email").val("");
				$("#email").focus();
				$("#mensajeadd").fadeIn(2000,function(){
					$("#mensajeadd").fadeOut(3000);
				});
			}
		}
		else
		{
			$("#mensajeadd").text("Debe ingresar todos los campos para continuar");
			$("#mensajeadd").addClass("red-text");
			$("#mensajeadd").removeClass("mybluetext");
			$("#mensajeadd").fadeIn(2000,function(){
				$("#mensajeadd").fadeOut(3000);
			});
		}
	});

	//Actualizar resguardatario
	$('#btnactualizarresguardatario').click(function(){
		var nombre = $("#txtnombreresact").val(); 
		var apellido = $("#txtapellidosresact").val();
		var titulo = $("#txttituloresact").val(); 
		var cargo = $("#txtcargoresact").val();
		var direccion = $("#cbxdireccionresact").val(); 
		var extension = $("#txtextensionresact").val();
		var email = $("#txtemailresact").val();
		var rfc = $("#txtrfcresact").val();
		var id = $('#txtidresg').val();
		var emailtest = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;

		if(nombre != "" && apellido != "" && titulo != "" && cargo != "" && direccion != "" && extension != "" && email != "" && rfc != "" && id != "")
		{
			if(emailtest.test(email))
			{
				$.ajax({
						url: 'Controllers/resguardatario/updresguardatario.php',
						method: 'POST',
						data: {nombre: nombre,apellido:apellido,titulo:titulo,cargo:cargo,direccion:direccion,extension:extension,email:email,rfc:rfc,id:id},
						success: function(msg){
							if(msg == "1")
							{
								$("#mensajeupd").text("Resguardatario actualizado correctamente");
								$("#mensajeupd").removeClass("red-text");
								$("#mensajeupd").fadeIn(2000,function(){
									$("#mensajeupd").fadeOut(3000,function(){
										mostrarreguardatario("");
									});
								});
							}
							else
							{
								alert(msg);
							}
							
						}					
				});
				
			}
			else
			{
				$("#mensajeupd").text("El correo ingresado no tiene el formato correcto");
				$("#mensajeupd").addClass("red-text");
				$("#mensajeupd").removeClass("mybluetext");
				$("#txtemailact").val("");
				$("#txtemailact").focus();
				$("#mensajeupd").fadeIn(2000,function(){
					$("#mensajeupd").fadeOut(3000);
				});
			}		}
		else
		{
			$("#mensajeupd").addClass("red-text");
			$("#mensajeupd").removeClass("mybluetext");
			$("#mensajeupd").text("Debe ingresar todos los campos");
			$("#mensajeupd").fadeIn(3000,function(){
				$("#mensajeupd").fadeOut(3000);
			});
		}

	});

	//Eliminiar reguardatario
	$("#btneliresguardatario").click(function(){
		var id = $('#txtidresgeli').val()

		if(id != "")
		{
			$.ajax({
				url: 'Controllers/resguardatario/deletereguardatario.php',
				method: 'POST',
				data: {id:id},
				success: function(msg){
					if(msg == "1")
					{
						$("#mensajedel").text("Resguardatario eliminado correctamente");
						$("#mensajedel").removeClass("red-text");
						$("#mensajedel").fadeIn(2000,function(){
							$("#mensajedel").fadeOut(3000,function(){
								mostrarreguardatario("");
							});
						});
					}
					else
					{
						alert(msg);
					}
				}					
			});
		}
	});
	//Buscar resguardatario
	$("#btnbuscarnomreguardatario").click(function(){
		var nombre = $("#txtnombrebusres").val();
		
		if (nombre != "") {
			mostrarreguardatario(nombre);
		}
		else
		{
			Materialize.toast("Ingrese nombre de resguardatario",3000,"rounded");
		}
	})
	//Mostrar resguardatario

	mostrarreguardatario("");

	/****************************************ACTIVO*****************************************/
	$("#btnregistraractivo").click(function(){
		var numprog = $("#txtnumprog").val();
		var clavecambs = $("#txtclavecambs").val();
		var descripcion = $("#txtdescripcion").val();
		var marca = $("#txtmarca").val();
		var modelo = $("#txtmodelo").val();
		var noserie = $("#txtnoserie").val();
		var nomotor = $("#txtnummotor").val();
		var nopedido = $("#txtnopedido").val();
		var noalta = $("#txtnumalta").val();
		var costo = $("#txtcosto").val();
		var aalta = $("#txtaalta").val();
		var resguardatario = $("#resguardatario").val();
		if(numprog != "" && clavecambs != "" && descripcion != ""  && nopedido != "" && noalta !="" && costo != "" && aalta != "" && resguardatario != "")
		{
			if(isNaN(costo))
			{
				$("#mensajeadd").text("Costo no tiene formato de número");
				$("#mensajeadd").addClass("red-text");
				$("#mensajeadd").removeClass("mybluetext");
				$("#txtcosto").val("");
				$("#txtcosto").focus();
				$("#mensajeadd").fadeIn(2000,function(){
					$("#mensajeadd").fadeOut(3000);
				});
			}
			else
			{
				$.ajax({
					url: 'Controllers/activo/addactivo.php',
					method: 'POST',
					data: {numprog:numprog,clavecambs:clavecambs,descripcion:descripcion,marca:marca,modelo:modelo,noserie:noserie,nomotor:nomotor,nopedido:nopedido,noalta:noalta,costo:costo,aalta:aalta,resguardatario:resguardatario},
					success: function(msg){
						if(msg == "1")
						{
							$("#mensajeadd").text("Activo ingresado correctamente");
							$("#mensajeadd").removeClass("red-text");
							$("#mensajeadd").fadeIn(2000,function(){
								$("#mensajeadd").fadeOut(3000);
							});
							$("#txtnumprog").val("");
							$("#txtclavecambs").val("");
							$("#txtdescripcion").val("");
							$("#txtmarca").val("");
							$("#txtmodelo").val("");
							$("#txtnoserie").val("");
							$("#txtnummotor").val("");
							$("#txtnopedido").val("");
							$("#txtnumalta").val("");
							$("#txtcosto").val("");
							$("#txtaalta").val("");
							llenarcomboresguadartario();
							mostraractivo("","","");
							$("label").removeClass("active");
							$("input").removeClass("valid");
						}
						else
						{
							alert(msg);
						}
					}					
				});
			}
		}
		else
		{
			$("#mensajeadd").text("Debe ingresar todos los campos para continuar");
			$("#mensajeadd").addClass("red-text");
			$("#mensajeadd").removeClass("mybluetext");
			$("#mensajeadd").fadeIn(2000,function(){
				$("#mensajeadd").fadeOut(3000);
			});
		}
	});

	//Actualizar Activo
	$("#btnactualizaractivo").click(function(){
		var descripcion = $("#txtdescripcionact").val();
		var noserie = $("#txtnoseriact").val();
		var marca = $("#txtmarcaact").val();
		var modelo = $("#txtmodeloact").val();
		var nomotor = $("#txtnomotorsact").val();
		var costo = $("#txtcostosact").val();
		var res = document.getElementById("cbxresguardatarioact").value;
		var id_activo = $("#txtidactivoact").val();
		var id_categoria = $("#txtidcategoriaact").val();
		if(descripcion != "" && costo != "" && resguardatario != "" && id_activo != "" && id_categoria != "")
		{
			$.ajax({
				url: 'Controllers/activo/updactivo.php',
				method: 'POST',
				data: {descripcion:descripcion,noserie:noserie,marca:marca,modelo:modelo,nomotor:nomotor,costo:costo,id_activo:id_activo,id_categoria:id_categoria,resguardatario:res},
				success: function(msg){
					if(msg == "1")
					{
						$("#mensajeupd").text("Resguardatario actualizado correctamente");
						$("#mensajeupd").removeClass("red-text");
						$("#mensajeupd").fadeIn(2000,function(){
							$("#mensajeupd").fadeOut(3000,function(){
								mostraractivo("","","");
							});
						});
					}
					else
					{
						alert(msg);
					}
				}					
			});
			
		}
		else
		{
			$("#mensajeupd").addClass("red-text");
			$("#mensajeupd").removeClass("mybluetext");
			$("#mensajeupd").text("Debe ingresar todos los campos");
			$("#mensajeupd").fadeIn(3000,function(){
				$("#mensajeupd").fadeOut(3000);
			});
		}
	});

	//Eliminar activo
	$('#btneliminaractivo').click(function(){
		var id_activo = $('#txtidactivoeli').val();

		if(id_activo != "")
		{
			$.ajax({
				url: 'Controllers/activo/deleteactivo.php',
				method: 'POST',
				data: {id_activo:id_activo},
				success: function(msg){
					if(msg == "1")
					{
						$("#mensajedel").text("Activo eliminado correctamente");
						$("#mensajedel").removeClass("red-text");
						$("#mensajedel").fadeIn(2000,function(){
							$("#mensajedel").fadeOut(3000,function(){
								mostraractivo("","","");
							});
						});
					}
					else
					{
						alert(msg);
					}
				}					
			});
		}
	});

	//Buscar Activo
	$('#btnbuscaractivo').click(function(){
		var nombre = $('#txtbusresguardatario').val();
		var clave = $('#txtbusclave').val();
		var numprog = $('#txtbusnumprog').val();

		if(nombre != "" || clave != "" || numprog != "")
		{
			mostraractivo(nombre,clave,numprog);
		}
		else
		{
			Materialize.toast("Ingrese al menos un campo para continuar",3000,"rounded");
		}
	});

	//Mostrar tabla activo

	mostraractivo("","","");

	//Cambiar de resguardatario Activo
	$('#btncambiarreguardatario').click(function(){
		var res = $('#cbxresguardatarioact').val();
		var ids = [];

		if(res != "")
		{
			//Extraigo los ids de checkedbox seleccionados
			var c = 0;
			$('.mycheckedbox').each(function(index){
				if($(this).is(':checked'))
				{
					var aux = $(this).attr("id").split("activo");
					var id = aux[1];
					ids[c] = id;
					c++;
				}
			});
			$.ajax({
				url: 'Controllers/activo/cambiarresguardatario.php',
				method: 'POST',
				data: {res:res,ids:ids},
				success: function(msg){
					if(msg == "1")
					{
						$("#mensajecam").text("Activos cambiados de resguardatario correctamente");
						$("#mensajecam").removeClass("red-text");
						$("#mensajecam").fadeIn(2000,function(){
							$("#mensajecam").fadeOut(3000,function(){
								mostrarreguardatario("");
							});
						});
					}
					else
					{
						alert(msg);
					}
				}					
			});
		}
		else
		{
			$("#mensajecam").addClass("red-text");
			$("#mensajecam").removeClass("mybluetext");
			$("#mensajecam").text("Debe ingresar todos los campos");
			$("#mensajecam").fadeIn(3000,function(){
				$("#mensajecam").fadeOut(3000);
			});
		}
	});

	//GENERAR REPORTE 

	$('#btngenerarreporte').click(function(){
		var resguardatario = $("#cbxresguardatariorep").val();
		var fechainicio = $("#txtfechaini").val();
		var fechafin = $("#txtfechafin").val();

		if(resguardatario == null &&  fechainicio == "" && fechafin == "")
		{
			Materialize.toast("Ingrese resgurdatario o fechas para continuar",3000,"rounded");
		}
		else
		{
			visualizartablareporte(resguardatario,fechainicio,fechafin);
		}
	});

});

//Muentro la tabla de los reportes
function visualizartablareporte(value,fechainicio,fechafin)
{
	$(".pnltablesreportes").hide();
	var f = new Date();
	if((f.getMonth() +1) <10)
	{
		var mes = "0"+(f.getMonth() +1);
	}
	else
	{
		var mes = (f.getMonth() +1);
	}
	$("#lblfecha").text("Fecha reporte: "+f.getDate() + "/" + mes + "/" + f.getFullYear());
	$.ajax({
		url: 'Controllers/reports/reporteresguardatario.php',
		method: 'POST',
		data: {id_resguardatario:value,fechainicio:fechainicio,fechafin:fechafin},
		success: function(msg){
			var array = eval(msg);
			if(array.length > 0)
			{
				var html ="";
				for(var i = 0; i< array.length;i++)
				{
					html+= '<tr><td>'+(i+1)+'</td><td>'+array[i][0]+'</td><td>'+array[i][1]+'</td><td>'+array[i][2]+'</td><td>'+array[i][3]+'</td><td>'+array[i][4]+'</td><td>'+array[i][5]+'</td><td>'+array[i][6]+'</td><td>'+array[i][7]+'</td><td>'+array[i][8]+'</td><td>'+array[i][9]+'</td></tr>';
				}
				$("#lbltotalregistros").text("Número de registros: "+i);
				$("#lblresguardatario").text("Resguardatario: "+array[0][10]);
				$("#lbldireccion").text("Dirección: "+array[0][11]);
				$("#tbodyreportes").html(html);
				$(".pnltablesreportes").show();
			}
			else
			{
				Materialize.toast("No hay datos con los filtros de busqueda utilizados",3000, "rounded");
			}
		}					
	});
	
}

function mostrarusuario(nombre)
{
	if($(".tabsuser").is(":visible"))
	{
		$.ajax({
			url: 'Controllers/users/consultaruser.php',
			method: 'POST',
			data: {nombre:nombre},
			success: function(msg){
				var array = eval(msg);
				var html ="";
				for(var i = 0; i< array.length;i++)
				{
					html+= '<tr><td>'+(i+1)+'</td><td>'+array[i][0]+'</td><td>'+array[i][1]+'</td><td>'+array[i][2]+'</td>';
					html+= '<td><a href="#actualizardatos" class="btn-floating btn waves-effect waves-light myblue modal-trigger myfloating tooltipped" data-position="bottom" data-delay="50" data-tooltip="Editar" onclick="pintardatosuser('+array[i][3]+')"><i class="material-icons">edit</i></a><a href="#eliminarrdatos" class="btn-floating btn waves-effect waves-light myblue modal-trigger myfloating tooltipped" data-position="bottom" data-delay="50" data-tooltip="Eliminar" onclick="pintaiduser('+array[i][3]+');"><i class="material-icons">delete</i></a</td></tr>';
				}
				$("#tbodyusers").html(html);
				$('.modal').modal();
				$('.tooltipped').tooltip({delay: 50});
			}					
		});
	}
}
function pintardatosuser(id)
{
	$.ajax({
		url: 'Controllers/users/detalleuser.php',
		method: 'POST',
		data: {id:id},
		success: function(msg){
			var array = eval(msg);

			$("#txtnombreact").val(array[0][0]);
			$("#txtapellidosact").val(array[0][1]);
			$("#txtemailact").val(array[0][2]);
			$("#txtiduser").val(id);
			$("#actualizardatos label").addClass("active");
		}					
	});
}

function pintaiduser(id)
{
	$("#txtiduserdel").val(id);
}

function llenarcombodirecciones()
{
	if($(".tabsresguardatario").is(":visible"))
	{
		$.ajax({
			url: 'Controllers/resguardatario/llenarcombodirecciones.php',
			method: 'POST',
			data: {},
			success: function(msg){
				var array = eval(msg);
				var html = "<option value'0' disabled selected>Seleccione Dirección</option>";
				for (var i = 0; i < array.length; i++) {
					
					html += "<option value='"+array[i][0]+"'>"+array[i][1]+"</option>";
				}
				$("#direccion").html(html);
				$('#cbxdireccionresact').html(html);
				$('select').material_select();
			}					
		});
	}
}

function llenarcombodireccionesact(value)
{
	$.ajax({
		url: 'Controllers/resguardatario/llenarcombodirecciones.php',
		method: 'POST',
		data: {},
		success: function(msg){
			var array = eval(msg);
			var html = "";
			for (var i = 0; i < array.length; i++) {

				if (array[i][0] == value) 
				{
					html += "<option value='"+array[i][0]+"' selected>"+array[i][1]+"</option>";
				}
				else
				{
					html += "<option value='"+array[i][0]+"'>"+array[i][1]+"</option>";
				}

				
			}
			$("#direccion").html(html);
			$('#cbxdireccionresact').html(html);
			$('select').material_select();
		}					
	});
}

function llenarcomboresguadartario()
{
	if($(".tabsresguardatario").is(":visible") || $(".tabsactivo").is(":visible") || $('.tabsreportes').is(":visible"))
	{
		$.ajax({
			url: 'Controllers/resguardatario/llenarcomboresguardatario.php',
			method: 'POST',
			data: {},
			success: function(msg){
				var array = eval(msg);
				var html = "<option value'0' disabled selected>Seleccione Resguardatario</option>";
				for (var i = 0; i < array.length; i++) {
					
					html += "<option value='"+array[i][0]+"'>"+array[i][1]+"</option>";
				}
				$("#cbxresguardatarioact").html(html);
				$('#resguardatario').html(html);
				$('#cbxresguardatariorep').html(html);
				$('#cbxresguardatariocar').html(html);
				$('select').material_select();
			}					
		});
	}
}

function llenarcomboresguadartarioact(value)
{
	$.ajax({
		url: 'Controllers/resguardatario/llenarcomboresguardatario.php',
		method: 'POST',
		data: {},
		success: function(msg){
			var array = eval(msg);
			var html = "";
			for (var i = 0; i < array.length; i++) {
				if(array[i][0] == value)
				{
					html += "<option value='"+array[i][0]+"' selected>"+array[i][1]+"</option>";
				}
				else
				{
					html += "<option value='"+array[i][0]+"'>"+array[i][1]+"</option>";
				}
				
			}
			$("#cbxresguardatarioact").html(html);
			$('#resguardatario').html(html);
			$('select').material_select();
		}					
	});
}

function mostrarreguardatario(nombre)
{
	if($(".tabsresguardatario").is(":visible"))
	{
		$.ajax({
				url: 'Controllers/resguardatario/mostrarresguardatarios.php',
				method: 'POST',
				data: {nombre:nombre},
				success: function(msg){
					var array = eval(msg);
					var html ="";
					for(var i = 0; i< array.length;i++)
					{
						html+= '<tr><td>'+(i+1)+'</td><td>'+array[i][0]+'</td><td>'+array[i][1]+'</td><td>'+array[i][2]+'</td><td>'+array[i][3]+'</td><td>'+array[i][4]+'</td><td>'+array[i][5]+'</td><td>'+array[i][6]+'</td>';
						html+= '<td><a href="#actualizardatosres" class="btn-floating btn waves-effect waves-light myblue modal-trigger myfloating tooltipped" data-position="bottom" data-delay="50" data-tooltip="Editar" onclick="detalleresguardatario('+array[i][7]+');"><i class="material-icons">edit</i></a>';
						html+= '<a href="#eliminarrdatosres" class="btn-floating btn waves-effect waves-light myblue modal-trigger myfloating tooltipped" data-position="bottom" data-delay="50" data-tooltip="Eliminar" onclick="pintaridresguardatario('+array[i][7]+')"><i class="material-icons">delete</i></a>';
						html+= '<a href="#cambiarresguardatario" class="btn-floating btn waves-effect waves-light myblue modal-trigger myfloating tooltipped" data-position="bottom" data-delay="50" data-tooltip="Cambiar Resguardatario" onclick="mostraractivoresguardatario('+array[i][7]+')"><i class="material-icons">weekend</i></a></td>';
					}
					$("#tbodyreguardatarios").html(html);
					$('.modal').modal();
					$('.tooltipped').tooltip({delay: 50});
				}					
		});
	}
}

function detalleresguardatario(id)
{
	$.ajax({
		url: 'Controllers/resguardatario/detalleresguardatarios.php',
		method: 'POST',
		data: {id:id},
		success: function(msg){
			var array = eval(msg);
			$("#txtnombreresact").val(array[0][0]);
			$("#txtapellidosresact").val(array[0][1]);
			$("#txtrfcresact").val(array[0][2]);
			$("#txttituloresact").val(array[0][3]);
			$("#txtcargoresact").val(array[0][4]);
			llenarcombodireccionesact(array[0][5]);
			$("#txtextensionresact").val(array[0][6]);
			$("#txtemailresact").val(array[0][7]);
			$("#txtidresg").val(id);
			$("#actualizardatosres label").addClass("active");
		}					
	});
}

function pintaridresguardatario(id)
{
	$("#txtidresgeli").val(id);
}

function mostraractivo(nom,cla,num)
{
	if($(".tabsactivo").is(":visible"))
	{
		$.ajax({
				url: 'Controllers/activo/consultaactivo.php',
				method: 'POST',
				data: {nombre:nom,clave:cla,numero:num},
				success: function(msg){
					var array = eval(msg);
					var html ="";
					for(var i = 0; i< array.length;i++)
					{
						html+= '<tr><td>'+(i+1)+'</td><td>'+array[i][0]+'</td><td>'+array[i][1]+'</td><td>'+array[i][2]+'</td><td>'+array[i][3]+'</td><td>'+array[i][4]+'</td>';
						html+= '<td><a href="#detalleactivo" class="btn-floating btn waves-effect waves-light myblue modal-trigger myfloating tooltipped" data-position="bottom" data-delay="50" data-tooltip="Detalle" onclick="mostrardetalleactivo('+array[i][6]+');"><i class="material-icons">visibility</i></a>';
						html+= '<a href="#actualizardatosactivo" class="btn-floating btn waves-effect waves-light myblue modal-trigger myfloating tooltipped" data-position="bottom" data-delay="50" data-tooltip="Editar" onclick="mostrardetalleactivoact('+array[i][6]+');"><i class="material-icons">edit</i></a>';
						html+= '<a href="#eliminarrdatosactivo" class="btn-floating btn waves-effect waves-light myblue modal-trigger myfloating tooltipped" data-position="bottom" data-delay="50" data-tooltip="Eliminar" onclick="pintaridactivo('+array[i][5]+')"><i class="material-icons">delete</i></a></td></tr>';
					}
					$("#tbodyactivo").html(html);
					$('.modal').modal();
					$('.tooltipped').tooltip({delay: 50});
				}					
		});
	}
}

function mostrardetalleactivo(id)
{
	$.ajax({
		url: 'Controllers/activo/detalleactivo.php',
		method: 'POST',
		data: {id:id},
		success: function(msg){
			var array = eval(msg);
			var html ="";
			for(var i = 0; i< array.length;i++)
			{
				html+= '<tr><td>'+array[i][0]+'</td><td>'+array[i][1]+'</td><td>'+array[i][2]+'</td><td>'+array[i][3]+'</td><td>'+array[i][4]+'</td><td>'+array[i][5]+'</td><td>'+array[i][6]+'</td></tr>';
			}
			$("#tbodydetalleactivo").html(html);
		}					
	});
}

function mostrardetalleactivoact(id)
{
	$.ajax({
		url: 'Controllers/activo/detalleactivo.php',
		method: 'POST',
		data: {id:id},
		success: function(msg){
			var array = eval(msg);
			$('#txtdescripcionact').val(array[0][0]);
			$('#txtnoseriact').val(array[0][1]);
			$('#txtmarcaact').val(array[0][2]);
			$('#txtmodeloact').val(array[0][3]);
			$('#txtnomotorsact').val(array[0][4]);
			$('#txtcostosact').val(array[0][6]);
			$('#txtidactivoact').val(array[0][8]);
			$('#txtidcategoriaact').val(array[0][9]);
			llenarcomboresguadartarioact(array[0][7]);
			$("#actualizardatosactivo label").addClass("active");
		}					
	});
}

function pintaridactivo(id)
{
	$('#txtidactivoeli').val(id);
}

function mostraractivoresguardatario(id)
{
	$.ajax({
		url: 'Controllers/activo/consultaactivores.php',
		method: 'POST',
		data: {id:id},
		success: function(msg){
			var array = eval(msg);
			var html = "";

			for(var i = 0; i<array.length;i++)
			{
				html+= '<div class="col l4 m6 s12">';
				html+= '<p><input type="checkbox" class="filled-in mycheckedbox" id="activo'+array[i][1]+'" checked="checked" /><label for="activo'+array[i][1]+'">'+array[i][0]+'</label></p>';
				html+= '</div>';
			}
			llenarcomboresguadartarioact(id);
			$('.pnlactivos').html(html);
		}					
	});
}
function pintaridresrep(id)
{
	$("#txtid_resguardatariorep").val(id);
	$("#btngenerarcarta").show();
}