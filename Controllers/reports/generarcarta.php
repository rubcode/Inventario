<?php 
	include("../constantes.php");
	include ("../../Model/conexion.php");
	require_once '../../dompdf/autoload.inc.php';
	use Dompdf\Dompdf;

	if (isset($_POST['txtid_resguardatariorep'])) 
	{
		$id = $_POST['txtid_resguardatariorep'];
		$cnx = new conexion();
		$cnx->conectar();
		$temp = $cnx->reporteresguardatario($id,"","");
		$cuerpo = HEADER;
		$cuerpo .='

			<div><span class="titulos center">Adquisición de Bienes Inmuebles: '.$temp[0][11].'</span>
			<span class="left">Fecha:'.date('d').'/'.date('m').'/'.date('Y').'</span></div>
			<div><span class="titulos">Resguardatario: '.$temp[0][10].'</span><span class="left">Total Registros: '.count($temp).' </span>
			</div></div><div class="main"><table><thead><tr><th>CAMBS</th><th>Num_prog</th><th>Descripción</th><th>Costo</th>
			<th>Marca</th><th>Modelo</th><th>Num serie</th><th>Num Motor</th><th>Num Pedido</th><th>Fecha Alta</th></tr></thead><tbody>';

		for($i = 0; $i<count($temp);$i++)
		{
			$cuerpo.="<tr><td>".$temp[$i][2]."</td><td>".$temp[$i][0]."</td><td>".$temp[$i][1]."</td><td>".$temp[$i][9]."</td><td>".$temp[$i][7]."</td><td>".$temp[$i][8]."</td><td>".$temp[$i][3]."</td><td>".$temp[$i][4]."</td><td>".$temp[$i][5]."</td><td>".date_format($temp[$i][12],'d/m/Y H:i:s')."</td></tr>";
		}
		$cuerpo.= FOOTER;
		// instantiate and use the dompdf class

		$dompdf = new Dompdf();
		$dompdf->loadHtml($cuerpo);

		// (Optional) Setup the paper size and orientation
		$dompdf->setPaper('A4', 'landscape');

		// Render the HTML as PDF
		$dompdf->render();

		// Output the generated PDF to Browser
		$dompdf->stream('Carta.pdf');
	}
?>