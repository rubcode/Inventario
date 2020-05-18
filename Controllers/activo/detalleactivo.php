<?php 
	include ("../../Model/conexion.php");

	$cnx = new conexion();
	$cnx->conectar();

	$id = $_POST['id'];
	
	$cnx->detalleactivo($id);
	$cnx->desconectar();

?>