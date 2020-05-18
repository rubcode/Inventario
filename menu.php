<?php 
	include("headers/header.php");
	session_start();
	if($_SESSION['permiso'] == 1  && $_SESSION['id_user']  != '') 
	{
?>
	<main id="mainlogin">
		<div class="container mymenu">
			
		</div>
	</main>
<?php 
		include("headers/footer.php");
	}
	else
	{
		header('location: index.php');
	}
?>
