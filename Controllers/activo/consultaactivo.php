<?php 
	include ("../../Model/conexion.php");

	$cnx = new conexion();
	$cnx->conectar();

	$nom = $_POST['nombre'];
	$cla = $_POST['clave'];
	$num = $_POST['numero'];

	$cnx->mostraractivo($nom,$cla,$num);
	$cnx->desconectar();

?>