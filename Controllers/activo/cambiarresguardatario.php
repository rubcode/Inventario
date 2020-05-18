<?php 
	include ("../../Model/conexion.php");

	$cnx = new conexion();
	$cnx->conectar();

	$res = $_POST['res'];
	$ids = $_POST['ids'];
	$cnx->cambiarresguardatario($res,$ids);
	$cnx->desconectar();

?>