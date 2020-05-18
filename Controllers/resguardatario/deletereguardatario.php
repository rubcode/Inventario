<?php 
	include ("../../Model/conexion.php");

	$cnx = new conexion();
	$cnx->conectar();

	$idr = $_POST['id'];

	$cnx->deletereguardatario($idr);
	$cnx->desconectar();

?>