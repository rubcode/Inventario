<?php 
	include ("../../Model/conexion.php");

	$cnx = new conexion();
	$cnx->conectar();

	$des = $_POST['descripcion'];
	$mar = $_POST['marca']; 
	$mod = $_POST['modelo']; 
	$nos = $_POST['noserie']; 
	$nom = $_POST['nomotor']; 
	$cos = $_POST['costo'];
	$res = $_POST['resguardatario'];
	$ida = $_POST['id_activo'];
	$idc = $_POST['id_categoria'];

	$cnx->actualizaractivo($des,$mar,$mod,$nos,$nom,$cos,$res,$ida,$idc);
	$cnx->desconectar();

?>