<!DOCTYPE html>
<html>
<head>
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/materialize.css">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<title>Invertario Conamed</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
</head>
<body>
	<header>
		<nav class="grey">
		    <div class="nav-wrapper">
		      <a href="#" class="brand-logo">Inventario CONAMED</a>
		    </div>
		</nav>
	</header>
	<main id="mainlogin">
		<div class="container pnllogin">
			<div class="row pnlheader myblue">
				<h5 class="titleheaderlogin white-text">Login</h5>
			</div>
			<div class="row pnlbody">
				<div class="col s12 input-field">
					<i class="material-icons prefix">account_circle</i>
					<input type="text" name="user" id="user" class="validate">
					<label for="user">Usuario</label>
				</div>
				<div class="col s12 input-field">
					<i class="material-icons prefix">https</i>
					<input type="password" name="pass" id="pass" class="validate">
					<label for="pass">Contraseña</label>
				</div>
				<div class="col s12 center">
					<h5 class="mybluetext" id="mensaje"></h5>
				</div>
				<div class="col s12 input-field center">
					<a href="#" class="waves-effect waves-light btn myblue" id="ingresarlogin">Ingresar</a>
				</div>
			</div>
		</div>
	</main>
	<footer class="page-footer grey">
        <div class="container">
            <div class="row">
              <div class="col s12 center">
                <h6 class="white-text copyright">© <?php echo date("Y") ;?> Copyright CONAMED</h6>
              </div>
            </div>
        </div>
    </footer>        
<script type="text/javascript" src="js/materialize.js"></script>
<script type="text/javascript" src="js/functions.js"></script>
</body>
</html>