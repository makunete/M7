<?php
	session_start();

	//print_r($_SESSION);
?>

<!DOCTYPE html>
<html lang="en">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css " rel=stylesheet>
<head>
	<meta charset="UTF-8">
	<style>
	nav { background-image: url("back4.jpg"); }
</style>
	<nav class="navbar navbar-default">
  <div class="page-header">
    
      <h1 style="text-align: center;"><img src="msv_transparente.png" alt="..." class="img-rounded"></h1>
    
  </div>
</nav>
</head>

<?php 

	if (isset($_POST['entrar'])) {
		if (!empty($_POST['usuari']) && !empty($_POST['password'])) {
			$usuari = $_POST['usuari'];
			$password = hash('sha256', $_POST['password']);
		}
	

			header('Content-Type: text/html; charset=UTF-8');
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

			$stmt = $pdo->prepare('SELECT * FROM usuaris WHERE nombre = :usuari AND contrasenya = :contrasenya' );

			$stmt->execute(array(':usuari' => $usuari, ':contrasenya' => $password));

			foreach ($stmt as $row) {
				echo "Hola holita <strong>".$row['nombre'].".</strong><br>\n";
				//$login=true;

				$_SESSION['usuari']=$usuari;

				/*echo "Amb 'contrasenya': ".$row['contrasenya']."<br>\n";
				$passHash = hash('sha256', $_POST['password']);
				echo ($passHash.'<br>');
				echo (strlen($passHash).' longitud<br>');*/
		    }

	}

?>

<body>
	<div class="container register">
	<div class="panel panel-default">
	<h1 class="text-center">Login</h1>
	<div class="panel-body">
	<form method="post">
	<p class="text-center">
		<label>Usuari:</label><br>
		<input type="text" name="usuari" size="32"><br>
	</p>
	<p class="text-center">
		<label>Password:</label><br>
		<input type="password" name="password" size="32"><br>
	</p>
	<p class="text-center">
		<input type="submit" name="entrar" value="Entra"/>
	</p>
		
	</form>	

	<p class="text-center">No tienes una cuenta? <a href="registro.php">Regístrate aquí!</a>!</p>
	</div>
	</div>
	</div>


</body>
</html>