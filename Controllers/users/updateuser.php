<?php 
	include ("../../Model/conexion.php");

	$cnx = new conexion();

	$cnx->conectar();

	$nom = $_POST["nombre"];
	$app = $_POST["apellido"];
	$ema = $_POST["email"];
	$id = $_POST["id"]; 

	$cnx->actualizaruser($nom,$app,$ema,$id);

	$cnx->desconectar();

?>