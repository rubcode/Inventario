<?php 
	include ("../../Model/conexion.php");

	$cnx = new conexion();
	$cnx->conectar();

	$nom = $_POST['nombre'];
	$app = $_POST['apellido'];
	$tit = $_POST['titulo'];
	$car = $_POST['cargo']; 
	$rfc = $_POST['rfc']; 
	$dir = $_POST['direccion']; 
	$ext = $_POST['extension']; 
	$ema = $_POST['email'];

	$cnx->registrarresguardatarios($nom,$app,$tit,$car,$rfc,$dir,$ext,$ema);
	$cnx->desconectar();

?>