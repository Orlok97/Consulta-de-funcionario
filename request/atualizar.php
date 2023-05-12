<?php
require_once('../conn.php');
header('Content-Type:application/json');

function editar($conn,$nome,$genero,$cargo,$id){
	$sql="UPDATE funcionario SET nome='$nome',sexo='$genero', cargo='$cargo' WHERE id=$id ";
	if(mysqli_query($conn,$sql)):
		return json_encode(array("status"=>"registro modificado com sucesso!"));
	else:
		return json_encode(array("status"=>"erro ao modificar"));
	endif;
}

if($_SERVER['REQUEST_METHOD']=='PUT'):
	$form=json_decode(file_get_contents("php://input"),true);
	$nome=$form['nome'];
	$genero=$form['genero'];
	$cargo=$form['cargo'];
	$id=$_GET['id'];
	if(!empty($nome) && !empty($genero) && !empty($cargo)):
		echo editar($conn,$nome,$genero,$cargo,$id);
	else:
		echo json_encode(array("status"=>"os campos nao podem ficar vazio"));
	endif;
else:
	echo json_encode(array('status'=>'requisição inválida'));
endif;