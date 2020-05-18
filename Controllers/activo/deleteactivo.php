<?php 
	include ("../../Model/conexion.php");

	$cnx = new conexion();
	$cnx->conectar();

	$id = $_POST['id_activo'];
	
	$cnx->eliminaractivo($id);
	$cnx->desconectar();

?>