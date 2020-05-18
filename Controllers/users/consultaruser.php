<?php 
	include ("../../Model/conexion.php");

	$cnx = new conexion();

	$nom = $_POST['nombre'];

	$cnx->conectar();
	$cnx->mostraruser($nom);
	$cnx->desconectar();
?>