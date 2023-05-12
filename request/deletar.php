<?php
require_once('../conn.php');
header('Content-Type:application/json');

function deletar($conn,$id){
	$sql="DELETE FROM funcionario WHERE id=$id";
	$res=mysqli_query($conn,$sql);
	if($res):
		return json_encode(array("status"=>"registro excluido com sucesso!"));
	else:
		return json_encode(array("status"=>"erro ao deletar o registro!"));
	endif;
}
if($_SERVER['REQUEST_METHOD']=='DELETE'):
	$id=$_GET['id'];
	echo deletar($conn,$id);
else:
	echo json_encode(array("status"=>"erro na requisição"));
endif;
