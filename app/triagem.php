<?php

session_start();
include 'conexao.php';

class Triagem {
	protected $id;
	
	public function setid($id) {
		$this->id = $id;
	}
	
	public function efetuar() {
		$con = new Conexao;
		$con->criar();
		$con->selecionar();
		$con->executar("call atualiza_triagem('$this->id');");
		$con->fechar();
	}
}

$operacao = $_GET["operacao"];

if($operacao == 1) {
	$t = new Triagem;
	$t->setid($_SESSION["user_id"]);
	$t->efetuar();
	
	header("Location:../cliente.php");
}

?>
