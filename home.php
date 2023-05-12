<?php
session_start();
if(!$_SESSION['usuario'] && !$_SESSION['senha']){
	header("location:index.php");
}
$uri=$_SERVER['REQUEST_URI'];
// echo $uri;
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>Home</title>
</head>
<body>
	<header>
		<button id="cadastrar">cadastrar functionario</button>
		<a href="logout.php">sair</a>
	</header>

	<div id="container">
		<form method="POST" id="search-form">
			<input type="text" name="termo" id="busca" placeholder="Procure por algum registro..." autocomplete="off">
		</form>
		<div id="sugestao"></div>
		<table id="table"></table>
	</div>

	<div class="modal"></div>
	<!-- formulario de cadastro. -->
	<form id="insert-form" method="POST" class="input">
				<div class="close"><span id="insert-close">&times</span></div>
				<h2>Cadastre um novo funcionario</h2>
				Nome:<input type="text" class="insert-input" autocomplete="off" name="nome">
				Sexo:<select name="genero">
					<option>Masculino</option>
					<option>Feminino</option>
					<option>Outro</option>
				</select>
				Cargo:<input type="text" class="insert-input" autocomplete="off" name="cargo">
				<button type="submit">Cadastrar</button>
			</form>

	<!-- formulario de edição. -->
	<form id="edit-form" method="PUT" class="input">
				<div class="close"><span id="edit-close">&times</span></div>
				<h2>Editar o registro</h2>
				Nome:<input type="text" class="edit-input" autocomplete="off" name="nome" id="nome">
				Sexo:<select name="genero" id="genero">
					<option>Masculino</option>
					<option>Feminino</option>
					<option>Outro</option>
				</select>
				Cargo:<input type="text" class="edit-input" autocomplete="off" name="cargo" id="cargo">
				<button type="submit">Concluir</button>
			</form>
<script src="js/script.js"></script>
</body>
</html>