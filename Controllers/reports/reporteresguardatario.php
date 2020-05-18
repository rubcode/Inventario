<?php 
	include ("../../Model/conexion.php");

	$cnx = new conexion();
	$cnx->conectar();

	$id = $_POST['id_resguardatario'];
	$fei = $_POST['fechainicio'];
	$fef = $_POST['fechafin'];

	echo json_encode($cnx->reporteresguardatario($id,$fei,$fef));
	$cnx->desconectar();

?>