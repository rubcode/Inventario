<?php
	include ("../../Model/conexion.php");

	$cnx = new conexion();
	$cnx->conectar();
	$nom = $_POST['nombre'];
	$cnx->mostrarresguardatarios($nom);
	$cnx->desconectar();
?>