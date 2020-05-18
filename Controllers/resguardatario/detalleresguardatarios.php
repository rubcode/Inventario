<?php
	include ("../../Model/conexion.php");

	$cnx = new conexion();
	$cnx->conectar();

	$id = $_POST['id'];

	$cnx->detalleresguardatario($id);
	$cnx->desconectar();
?>