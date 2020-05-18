<?php 
	include ("../../Model/conexion.php");

	$cnx = new conexion();

	$cnx->conectar();

	$usu = $_POST["user"]; 
	$pas = md5($_POST["password"]);

	$cnx->login($usu,$pas);

	$cnx->desconectar();

?>