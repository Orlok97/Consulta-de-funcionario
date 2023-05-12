<?php
require_once("../conn.php");
header('Content-Type:application/json');

function getData($conn){
	$sql="SELECT * FROM funcionario ORDER BY id DESC";
	$dados=array();
	$res=mysqli_query($conn,$sql);
	if(mysqli_num_rows($res)>0):
		while($row=mysqli_fetch_assoc($res)):
			$dados[]=$row;
		endwhile;
		return json_encode($dados);
	else:
		return json_encode(array("status"=>"vazio"));
	endif;
}
if($_SERVER['REQUEST_METHOD']=='GET'):
	echo getData($conn);
else:
	echo json_encode(array("status"=>"erro"));
endif;