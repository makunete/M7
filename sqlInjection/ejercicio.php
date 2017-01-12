<!DOCTYPE html>
<html>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css " rel=stylesheet>
<head>
<meta charset="UTF-8">
<style>
	nav { background-image: url("back3.jpg"); }
</style>
	<nav class="navbar navbar-default">
  <div class="page-header">
    
      <h1 style="text-align: center;"><img src="msv_logo_final.png" alt="..." class="img-rounded"></h1>
    
  </div>
</nav>
</head>
<body>
<?php

try {
		$hostname = "localhost";
		$dbname = "ejercicio";
		$username = "root";
	    $pass = "car18434";
	    $pdo = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$pass");
	    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch (PDOException $e) {
		echo "Failed to get DB handle: " . $e->getMessage() . "\n";
		exit;
	} 
?>	
	
<?php

	if (isset($_POST['entrar'])) {
		if (!empty($_POST['usuari']) && !empty($_POST['contrasenya'])) {
			$nombre = $_POST['usuari'];
			$contrasenya = hash('sha256', $_POST['contrasenya']);
		}
		

		$stmt = $pdo->prepare('INSERT INTO usuaris(nombre, contrasenya) VALUES( :nombre, :contrasenya)' );

		$stmt->execute(array(':nombre' => $nombre, ':contrasenya' => $contrasenya));

		

		
		if (isset($row))
		{
	    	echo "Te has registrado";;
	    	//exit;
		}

	}

 
?>


<div class="container register">
			<div id="login">
	<br>
	<div class="panel panel-default">
	<h1 class="text-center">Registrar</h1>
	<div class="panel-body">
<form name="registro" id="registro" action="ejercicio.php" method="post">
	<p class="text-center">
		<label>Nombre De Usuario<br />
		<input type="text" name="usuari" id="username" class="input" value="" size="32" /></label>
	</p>	
	
	
	<p class="text-center">
		<label>Contraseña<br />
		<input type="password" name="contrasenya" id="contrasenya" class="input" value="" size="32" /></label>
	</p>	
	

		<p class="text-center">
		<input type="submit" name="entrar" id="entrar" class="button" value="Registrar" />
		</p>

	
	<p class="text-center">Ya tienes una cuenta? <a href="login.php" >Entra aquí!</a>!</p>
</form>
	</div>
	</div>
	</div>
	</div>
</body>
</html>