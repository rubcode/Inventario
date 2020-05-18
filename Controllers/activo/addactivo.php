<?php 
	include ("../../Model/conexion.php");

	$cnx = new conexion();
	$cnx->conectar();

	$nop = $_POST['numprog'];
	$cla = $_POST['clavecambs'];
	$des = $_POST['descripcion'];
	$mar = $_POST['marca']; 
	$mod = $_POST['modelo']; 
	$nos = $_POST['noserie']; 
	$nom = $_POST['nomotor']; 
	$npd = $_POST['nopedido'];
	$noa = $_POST['noalta'];
	$cos = $_POST['costo'];
	$aal = $_POST['aalta'];
	$res = $_POST['resguardatario'];
	$fec = date("Y-m-d H:i:s");

	$cnx->registraractivo($nop,$cla,$des,$mar,$mod,$nos,$nom,$npd,$noa,$cos,$aal,$res,$fec);
	$cnx->desconectar();

?>