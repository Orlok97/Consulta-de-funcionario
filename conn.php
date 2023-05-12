<?php 

$conn=mysqli_connect('localhost','root','','consultadb');
if(!$conn){
	echo "Houve um erro na conexão!";
	exit;
}