<?php
require_once('../conn.php');

function buscar($conn,$termo){
	$sql="SELECT id,nome,cargo,sexo FROM funcionario WHERE nome LIKE '{$termo}%' ";
	$res=mysqli_query($conn,$sql);
	if(mysqli_num_rows($res)>0):
		while($row=mysqli_fetch_assoc($res)){
			$nome=$row['nome'];
			$id=$row['id'];
			$cargo=$row['cargo'];
			$sexo=$row['sexo'];
			$newNome=str_replace(' ','-',$nome);
			echo "<p onclick=showSingleRow($id,'$newNome','$sexo','$cargo')>".$nome."</p>";
	}
	else:
		echo "<p>nenhum registro encontrado!</p>";
	endif;
	
}
if($_SERVER['REQUEST_METHOD']=='POST'):
	$termo=$_POST['termo'];
	buscar($conn,$termo);
	
else:
	echo "requisição inválida";
endif;