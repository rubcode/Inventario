<?php 
	include ("../../Model/conexion.php");

	$cnx = new conexion();
	$cnx->conectar();
	$cnx->llenarcomboresguardatario();
	$cnx->desconectar();

?>