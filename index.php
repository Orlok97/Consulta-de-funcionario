<?php
session_start();
require_once('conn.php');
function logar($conn,$usuario,$senha){
	$sql="SELECT * FROM admin WHERE usuario='$usuario' AND senha='$senha'";
	$res=mysqli_query($conn,$sql);
	return mysqli_num_rows($res);
}
if(isset($_POST['submit'])){
	$usuario=$_POST['usuario'];
	$senha=$_POST['senha'];
	if(logar($conn,$usuario,$senha)>0):
		$_SESSION['usuario']=$usuario;
		$_SESSION['senha']=$senha;
		header('location: home.php');
	else:
		echo "usuario nao cadastrado!";
	endif;
}

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<title>Logar</title>
</head>
<body>
	<header></header>
	<section>
		<div id="container">
			<form action="" method="POST">
				<input type="text" name="usuario" autocomplete="off" placeholder="usuario"><br>
				<input type="password" name="senha" placeholder="senha"><br>
				<button type="submit" name="submit">logar</button>	
			</form>
		</div>
	</section>
	
	
</body>
</html>