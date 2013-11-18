<?php
include 'conexao.php';

$email = $_POST["email"];
$senha = $_POST["senha"];

if ($email == "admin" and $senha == "admin") {
	header("Location:../admin.html");
} else {
	$con = new Conexao;

	$con->criar();
	$con->selecionar();
	$con->login($email,$senha);
	
	$qtde = $con->qtde();
	
	if($qtde > 0) {
		$rst = $con->proxima();
		$con->fechar();
		session_start();
		$_SESSION["user_id"] = $rst["id"];
		$_SESSION["user_nome"] = $rst["nome"];
		header("Location:../cliente.php");
	} else {
		header("Location:../index.html");
	}	
	$con->fechar();
	
	session_start();
}
?>
