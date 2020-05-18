<?php 
	/**
	 * Clase Conexion
	 */
	class conexion
	{
		
		public $conexion;
		public $server = "RRRIVERO2\SQLEXPRESS";
		//En caso de usar usuario descomentar
		/*public $user = "userInventario";
		public $pass = "root";*/
		public $db = "Inventario";

		function conectar()
		{
			//En caso de usar usuario descomenyar
			//$connectionInfo = array("Database"=>$this->db, "UID"=>$this->user, "PWD"=>$this->pass);

			$connectionInfo = array("Database"=>$this->db);
			$this->conexion = sqlsrv_connect($this->server,$connectionInfo);
			if(!$this->conexion)
			{
				echo "Error al Conectar";
				die( print_r( sqlsrv_errors(), true));
			}
		}
		function desconectar()
		{
			sqlsrv_close($this->conexion);
		}

		function login($user,$con)
		{
			$query = "SELECT * FROM Usuarios WHERE user_name='".$user."' AND user_password_hash='".$con."' AND estado='A'";
			$params = array();
			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
			$consulta = sqlsrv_query($this->conexion,$query,$params,$options);
			if(sqlsrv_num_rows($consulta) > 0)
			{
				if($row = sqlsrv_fetch_array($consulta,SQLSRV_FETCH_ASSOC))
				{
					session_start();
					$_SESSION['permiso'] = 1;
					$_SESSION['id_user'] = $row['id_usuario'];
					echo "menu.php";
				}
			}
			else
			{
				$_SESSION['permiso'] = 0;
				$_SESSION['id_user'] = 0;
				echo "-1";
			}
		}
		function registraruser($nom,$app,$ema,$user,$con)
		{
			$hoy = date("Y-m-d H:i:s");
			$query = "SELECT * FROM Usuarios WHERE user_name='".$user."' AND estado = 'A'";
			$params = array();
			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
			$resultado = sqlsrv_query($this->conexion,$query,$params,$options);
			if(sqlsrv_num_rows($resultado) > 0)
			{
				echo "0";
			}
			else
			{
				$query ="INSERT INTO Usuarios(nombre,apellidos,user_name,user_password_hash,email,fecha_alta,estado) VALUES('".$nom."','".$app."','".$user."','".$con."','".$ema."','".$hoy."','A')";
				$resultado = sqlsrv_query($this->conexion,$query);
				if($resultado === false)
				{
					echo "-1";
				}
				else
				{
					echo "1";
				}
			}
		}
		function actualizaruser($nom,$app,$ema,$idu)
		{
			$query = "UPDATE Usuarios SET nombre='".$nom."', apellidos='".$app."', email='".$ema."' WHERE id_usuario=".$idu;
			$resultado = sqlsrv_query($this->conexion,$query);
			if($resultado === false)
			{
				echo "-1";
			}
			else
			{
				echo "1";
			}
		}
		function deletuser($idu)
		{
			$query = "UPDATE Usuarios SET estado='B' WHERE id_usuario=".$idu;
			$resultado = sqlsrv_query($this->conexion,$query);
			if($resultado === false)
			{
				echo "-1";
			}
			else
			{
				echo "1";
			}
		}
		function mostraruser($nom)
		{
			if($nom == "")
			{
				$query = "SELECT * FROM Usuarios WHERE estado = 'A'";
			}
			else
			{
				$query = "SELECT * FROM Usuarios WHERE estado = 'A' AND nombre='".$nom."'";
			}

			$params = array();
			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
			$consulta = sqlsrv_query($this->conexion,$query,$params,$options);
			$temp = array();
			$i = 0;
			while ($row = sqlsrv_fetch_array($consulta,SQLSRV_FETCH_ASSOC)) 
			{
				$temp[$i][0] = $row['nombre']." ".$row['apellidos'];
				$temp[$i][1] = $row['email'];
				$temp[$i][2] = $row['user_name'];
				$temp[$i][3] = $row['id_usuario'];
				$i++;
			}
			echo json_encode($temp);
		}
		function detalleuser($id)
		{
			$query = "SELECT * FROM Usuarios WHERE id_usuario=".$id." AND estado ='A'";
			$params = array();
			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
			$consulta = sqlsrv_query($this->conexion,$query,$params,$options);
			$temp = array();
			$i = 0;
			while ($row = sqlsrv_fetch_array($consulta,SQLSRV_FETCH_ASSOC)) 
			{
				$temp[$i][0] = $row['nombre'];
				$temp[$i][1] = $row['apellidos'];
				$temp[$i][2] = $row['email'];
				$i++;
			}
			echo json_encode($temp);
		}

		//RESGUARDATARIO

		function llenarcombodirecciones()
		{
			$query = "SELECT * FROM Direcciones WHERE estado='A'";
			$params = array();
			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET);
			$consulta = sqlsrv_query($this->conexion,$query,$params,$options);
			$temp = array();
			$i = 0;
			while ($row = sqlsrv_fetch_array($consulta,SQLSRV_FETCH_ASSOC)) 
			{
				$temp[$i][0] = utf8_encode($row['id_direccion']);
				$temp[$i][1] = utf8_encode($row['nombre_direccion']);
				$i++;
			}
			echo json_encode($temp);
		}
		function llenarcomboresguardatario()
		{
			$query = "SELECT * FROM Resguardatario WHERE estado='A' ORDER BY nombre";
			$params = array();
			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET);
			$consulta = sqlsrv_query($this->conexion,$query,$params,$options);
			$temp = array();
			$i = 0;
			while ($row = sqlsrv_fetch_array($consulta,SQLSRV_FETCH_ASSOC)) 
			{
				$temp[$i][0] = utf8_encode($row['id_resguardatario']);
				$temp[$i][1] = utf8_encode($row['nombre']." ".$row['apellido']);
				$i++;
			}
			echo json_encode($temp);
		}

		function registrarresguardatarios($nom,$app,$tit,$car,$rfc,$dir,$ext,$ema)
		{
			$query ="INSERT INTO Resguardatario(nombre,apellido,titulo,cargo,id_direccion,extension,email,rfc,estado) VALUES('".$nom."','".$app."','".$tit."','".$car."',".$dir.",'".$ext."','".$ema."','".$rfc."','A')";
			$resultado = sqlsrv_query($this->conexion,$query);
			if($resultado === false)
			{
				echo "-1";
			}
			else
			{
				echo "1";
			}
		}
		function actualizarresguardatarios($nom,$app,$tit,$car,$rfc,$dir,$ext,$ema,$id)
		{
			$query ="UPDATE Resguardatario SET nombre='".$nom."', apellido='".$app."', titulo='".$tit."', cargo='".$car."',id_direccion=".$dir.", extension='".$ext."',email='".$ema."',rfc='".$rfc."' WHERE id_resguardatario=".$id;
			$resultado = sqlsrv_query($this->conexion,$query);
			if($resultado === false)
			{
				echo "-1";
			}
			else
			{
				echo "1";
			}
		}
		function mostrarresguardatarios($nom)
		{
			if($nom == "")
			{
				$query = "SELECT * FROM Resguardatario a, Direcciones b WHERE a.id_direccion = b.id_direccion AND a.estado ='A'";
			}
			else
			{
				$query = "SELECT * FROM Resguardatario a, Direcciones b WHERE a.id_direccion = b.id_direccion AND a.estado ='A' AND nombre='".$nom."'";
			}
			
			$params = array();
			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
			$consulta = sqlsrv_query($this->conexion,$query,$params,$options);
			$temp = array();
			$i = 0;
			while ($row = sqlsrv_fetch_array($consulta,SQLSRV_FETCH_ASSOC)) 
			{
				$temp[$i][0] = utf8_encode($row['nombre']." ".$row['apellido']);
				$temp[$i][1] = $row['rfc'];
				$temp[$i][2] = $row['titulo'];
				$temp[$i][3] = utf8_encode($row['cargo']);
				$temp[$i][4] = utf8_encode($row['nombre_direccion']);
				$temp[$i][5] = $row['extension'];
				$temp[$i][6] = $row['email'];
				$temp[$i][7] = $row['id_resguardatario'];
				$i++;
			}
			echo json_encode($temp);
		}

		function detalleresguardatario($id)
		{
			$query = "SELECT * FROM Resguardatario WHERE id_resguardatario=".$id." AND estado ='A'";
			$params = array();
			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
			$consulta = sqlsrv_query($this->conexion,$query,$params,$options);
			$temp = array();
			$i = 0;
			while ($row = sqlsrv_fetch_array($consulta,SQLSRV_FETCH_ASSOC)) 
			{
				$temp[$i][0] = $row['nombre'];
				$temp[$i][1] = $row['apellido'];
				$temp[$i][2] = $row['rfc'];
				$temp[$i][3] = $row['titulo'];
				$temp[$i][4] = $row['cargo'];
				$temp[$i][5] = $row['id_direccion'];
				$temp[$i][6] = $row['extension'];
				$temp[$i][7] = $row['email'];
				$temp[$i][8] = $row['id_resguardatario'];
				$i++;
			}
			echo json_encode($temp);
		}

		function deletereguardatario($id)
		{
			$query = "UPDATE Resguardatario SET estado='B' WHERE id_resguardatario=".$id;
			$resultado = sqlsrv_query($this->conexion,$query);
			if($resultado === false)
			{
				echo "-1";
			}
			else
			{
				echo "1";
			}
		}

		/*******************************ACTIVOS************************************/

		function registraractivo($nop,$cla,$des,$mar,$mod,$nos,$nom,$npd,$noa,$cos,$aal,$res,$fec)
		{
			$query ="INSERT INTO Categorias(descripcion,marca,modelo,costo,num_pedido,fecha_alta,clave_cambs,num_serie,num_motor,num_alta,a_alta,estado) VALUES('".$des."','".$mar."','".$mod."',".$cos.",'".$npd."','".$fec."','".$cla."','".$nos."','".$nom."','".$noa."','".$aal."','A')";
			$resultado = sqlsrv_query($this->conexion,$query);

			if($resultado === false)
			{
				echo "-1";
			}
			else
			{
				$query = "INSERT INTO Activo_fijo(id_categoria,id_resguardatario,num_prog,estado) VALUES ((SELECT MAX(id_categoria) FROM Categorias),".$res.",".$nop.",'A')";
				$resultado = sqlsrv_query($this->conexion,$query);
				if($resultado === false)
				{
					echo "-2";
				}
				else
				{
					echo "1";
				}
			}
		}

		function mostraractivo($nom,$cla,$num)
		{
			$clasula = "";
			if($nom != "")
			{
				$clasula = " AND (c.nombre='".$nom."' OR c.rfc ='".$nom."')";
			}
			else if($cla != "")
			{
				$clasula = " AND b.clave_cambs='".$cla."'";
			}
			else if($num != "")
			{
				$clasula = " AND a.num_prog=".$num;
			}

			$query = "SELECT a.num_prog, a.id_activo_fijo, b.clave_cambs, b.num_alta, b.a_alta,b.id_categoria, c.nombre, c.apellido FROM Activo_fijo a, Categorias b,Resguardatario c WHERE a.id_categoria = b.id_categoria AND a.id_resguardatario = c.id_resguardatario AND a.estado = 'A'".$clasula;
			
			$params = array();
			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
			$consulta = sqlsrv_query($this->conexion,$query,$params,$options);
			$temp = array();
			$i = 0;
			while ($row = sqlsrv_fetch_array($consulta,SQLSRV_FETCH_ASSOC)) 
			{
				$temp[$i][0] = $row['num_prog'];
				$temp[$i][1] = $row['clave_cambs'];
				$temp[$i][2] = $row['num_alta'];
				$temp[$i][3] = $row['a_alta'];
				$temp[$i][4] = utf8_encode($row['nombre']." ".$row['apellido']);
				$temp[$i][5] = $row['id_activo_fijo'];
				$temp[$i][6] = $row['id_categoria'];
				$i++;
			}
			echo json_encode($temp);
		}

		function detalleactivo($id)
		{

			$query = "SELECT b.id_activo_fijo,b.id_resguardatario, a.id_categoria,a.descripcion,a.marca,a.modelo,a.num_motor,a.num_pedido, a.costo,a.num_serie FROM Categorias a, Activo_fijo b WHERE a.id_categoria = b.id_categoria  AND a.id_categoria =".$id;
			
			$params = array();
			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
			$consulta = sqlsrv_query($this->conexion,$query,$params,$options);
			$temp = array();
			$i = 0;
			while ($row = sqlsrv_fetch_array($consulta,SQLSRV_FETCH_ASSOC)) 
			{
				$temp[$i][0] = $row['descripcion'];
				$temp[$i][1] = $row['num_serie'];
				$temp[$i][2] = $row['marca'];
				$temp[$i][3] = $row['modelo'];
				$temp[$i][4] = $row['num_motor'];
				$temp[$i][5] = $row['num_pedido'];
				$temp[$i][6] = $row['costo'];
				$temp[$i][7] = $row['id_resguardatario'];
				$temp[$i][8] = $row['id_activo_fijo'];
				$temp[$i][9] = $row['id_categoria'];
				$i++;
			}
			echo json_encode($temp);
		}

		function actualizaractivo($des,$mar,$mod,$nos,$nom,$cos,$res,$ida,$idc)
		{
			$query ="UPDATE Activo_fijo SET id_resguardatario=".$res." WHERE id_activo_fijo=".$ida;
			$resultado = sqlsrv_query($this->conexion,$query);

			if($resultado === false)
			{
				echo "-1";
			}
			else
			{
				$query = "UPDATE Categorias SET descripcion='".$des."', marca='".$mar."', modelo='".$mod."', num_serie='".$nos."', num_motor='".$nom."',costo='".$cos."' WHERE id_categoria=".$idc;
				$resultado = sqlsrv_query($this->conexion,$query);
				if($resultado === false)
				{
					echo "-2";
				}
				else
				{
					echo "1";
				}
			}
		}

		function eliminaractivo($ida)
		{
			$query = "UPDATE Activo_fijo SET estado='B' WHERE id_activo_fijo=".$ida;
			$resultado = sqlsrv_query($this->conexion,$query);
			if($resultado === false)
			{
				echo "-1";
			}
			else
			{
				echo "1";
			}
		}

		function extraeractivoresguardatario($idr)
		{
			$query = "SELECT a.descripcion,b.id_activo_fijo FROM Categorias a, Activo_fijo b, Resguardatario c WHERE a.id_categoria = b.id_categoria AND b.id_resguardatario = c.id_resguardatario AND b.estado = 'A' AND b.id_resguardatario =".$idr;
			
			$params = array();
			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
			$consulta = sqlsrv_query($this->conexion,$query,$params,$options);
			$temp = array();
			$i = 0;
			while ($row = sqlsrv_fetch_array($consulta,SQLSRV_FETCH_ASSOC)) 
			{
				$temp[$i][0] = utf8_encode($row['descripcion']);
				$temp[$i][1] = $row['id_activo_fijo'];
				$i++;
			}
			echo json_encode($temp);
		}

		function cambiarresguardatario($res,$ids)
		{
			$ban = "0";
			for($i = 0; $i<count($ids); $i++)
			{
				$query = "UPDATE Activo_fijo SET id_resguardatario=".$res." WHERE id_activo_fijo=".$ids[$i];
				$resultado = sqlsrv_query($this->conexion,$query);
				if($resultado === false)
				{
					echo "-2";
					break;
				}
				else
				{
					$ban = "1";
				}
			}
			if($ban == "1")
			{
				echo "1";
			}
		}
		/*********************************REPORTES******************************************/
		function reporteresguardatario($id,$feci,$fecf)
		{

			if($feci != "" && $fecf != "")
			{
				$fecincio = $this->darformatofecha($feci);
				$fecfin = $this->darformatofecha($fecf);
				if($id != null)
				{
					$query = "SELECT b.num_prog ,a.descripcion,a.clave_cambs,a.num_serie,a.num_motor,a.num_pedido,a.num_alta,a.marca,a.modelo,a.costo,a.fecha_alta, c.nombre,c.apellido,d.nombre_direccion FROM Categorias a, Activo_fijo b, Resguardatario c, Direcciones d WHERE a.id_categoria = b.id_categoria AND b.id_resguardatario = c.id_resguardatario AND c.id_direccion = d.id_direccion AND b.estado = 'A' AND a.fecha_alta BETWEEN '".$fecincio."' AND '".$fecfin."' AND b.id_resguardatario =".$id;
				}
				else
				{
					$query = "SELECT b.num_prog ,a.descripcion,a.clave_cambs,a.num_serie,a.num_motor,a.num_pedido,a.num_alta,a.marca,a.modelo,a.costo,a.fecha_alta, c.nombre,c.apellido,d.nombre_direccion FROM Categorias a, Activo_fijo b, Resguardatario c, Direcciones d WHERE a.id_categoria = b.id_categoria AND b.id_resguardatario = c.id_resguardatario AND c.id_direccion = d.id_direccion AND b.estado = 'A' AND a.fecha_alta BETWEEN '".$fecincio."' AND '".$fecfin."'";
				}
			}
			else
			{
				$query = "SELECT b.num_prog ,a.descripcion,a.clave_cambs,a.num_serie,a.num_motor,a.num_pedido,a.num_alta,a.marca,a.modelo,a.costo,a.fecha_alta, c.nombre,c.apellido,d.nombre_direccion FROM Categorias a, Activo_fijo b, Resguardatario c, Direcciones d WHERE a.id_categoria = b.id_categoria AND b.id_resguardatario = c.id_resguardatario AND c.id_direccion = d.id_direccion AND b.estado = 'A' AND b.id_resguardatario =".$id;
			}
			$params = array();
			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
			$consulta = sqlsrv_query($this->conexion,$query,$params,$options);
			$temp = array();
			$i = 0;
			while ($row = sqlsrv_fetch_array($consulta,SQLSRV_FETCH_ASSOC)) 
			{
				$temp[$i][0] = $row['num_prog'];
				$temp[$i][1] = utf8_encode($row['descripcion']);
				$temp[$i][2] = $row['clave_cambs'];
				$temp[$i][3] = $row['num_serie'];
				$temp[$i][4] = $row['num_motor'];
				$temp[$i][5] = $row['num_pedido'];
				$temp[$i][6] = $row['num_alta'];
				$temp[$i][7] = $row['marca'];
				$temp[$i][8] = $row['modelo'];
				$temp[$i][9] = $row['costo'];
				$temp[$i][10] = $row['nombre']." ".$row['apellido'];
				$temp[$i][11] = utf8_encode($row['nombre_direccion']);
				$temp[$i][12] = $row['fecha_alta'];
				$i++;
			}
			return $temp;
		}

		public function darformatofecha($fecha)
		{
			    $temp= explode(",",$fecha);
		    	$formateada= $temp[0]." ".$temp[1];
				$temp = explode(" ",$formateada);
				switch ($temp[1]) {
					case 'Enero':
						$temp[1]=1;
						break;
					case 'Febrero':
						$temp[1]=2;
						break;
					case 'Marzo':
						$temp[1]=3;
						break;
					case 'Abril':
						$temp[1]=4;
						break;
					case 'Mayo':
						$temp[1]=5;
						break;
					case 'Junio':
						$temp[1]=6;
						break;
					case 'Julio':
						$temp[1]=7;
						break;
					case 'Agosto':
						$temp[1]=8;
						break;
					case 'Septiembre':
						$temp[1]=9;
						break;
					case 'Octubre':
						$temp[1]=10;
						break;
					case 'Noviembre':
						$temp[1]=11;
						break;
					case 'Deciembre';
						$temp[1]=12;
						break;
					
				}
				$formateada = $temp[3]."-".$temp[1]."-".$temp[0];
				return $formateada;
		}


	}
?>