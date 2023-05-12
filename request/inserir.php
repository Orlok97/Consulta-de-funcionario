<?php
require_once('../conn.php');
header("Content-Type:application/json");

function inserir($conn,$nome,$genero,$cargo){
	$sql="INSERT INTO funcionario(nome,sexo,cargo)VALUES('$nome','$genero','$cargo')";
	$res=mysqli_query($conn,$sql);
	if($res):
		return json_encode(array("status"=>"sucesso"));
	else:
		return json_encode(array("status"=>"erro"));
	endif;

}
if($_SERVER['REQUEST_METHOD']=="POST"){
	$nome=$_POST['nome'];
	$genero=$_POST['genero'];
	$cargo=$_POST['cargo'];
	if(!empty($nome)&& !empty($genero) && !empty($cargo)):
		echo inserir($conn,$nome,$genero,$cargo);
	else:
		echo json_encode(array("status"=>"os campos nao devem ficar vazio!"));
	endif;
}else{
	echo json_encode(array("status"=>"requisição inválida"));
}