<?php
include 'conexao.php';
include 'HashCodeGenerator.php';

$email = $_POST["email"];
$senha = $_POST["senha"];

//if ($email == "admin" and $senha == "admin") {
if ($email == "admin") {
	$hashClass = new HashCodeGenerator;
	$hash = $hashClass->generateNewHash($senha);

	$con = new Conexao;

	$con->criar();
	$con->selecionar();
	$con->login($email,$hash);
	
	$qtde = $con->qtde();
	
	if($qtde > 0) {
		$rst = $con->proxima();
		$con->fechar();
		header("Location:../admin.html");
	} else {
		header("Location:../index.html");
	}	
	
	
	
} else {
	$hashClass = new HashCodeGenerator;
	$hash = $hashClass->generateNewHash($senha);

	$con = new Conexao;

	$con->criar();
	$con->selecionar();
	$con->login($email,$hash);
	
	$qtde = $con->qtde();
	
	if($qtde > 0) {
		$rst = $con->proxima();
		$con->fechar();
		if($rst["acesso"] == 1){
			session_start();
			$_SESSION["user_id"] = $rst["id"];
			$_SESSION["user_nome"] = $rst["nome"];
			header("Location:../cliente.php");
		} else{
			header("Location:../bloqueado.html");
		}
	} else {
		//echo $email."<br>".$hash;
		header("Location:../index.html");
	}	
	//$con->fechar();
	
	//session_start();
}
?>
