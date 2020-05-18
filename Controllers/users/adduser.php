<?php 
	include ("../../Model/conexion.php");

	$cnx = new conexion();

	$cnx->conectar();

	$nom = $_POST["nombre"];
	$app = $_POST["apellido"];
	$ema = $_POST["email"];
	$usu = $_POST["user"]; 
	$pas = md5($_POST["password"]);

	$cnx->registraruser($nom,$app,$ema,$usu,$pas);

	$cnx->desconectar();

?>