<?php

include 'conexao.php';

class BloquearAcesso{

	protected $id;
	
	public function bloquear($id) {
		$con = new Conexao;
		$con->criar();
		$con->selecionar();
		$con->executar("UPDATE cliente SET acesso = 0 WHERE id = $id;");
		$con->fechar;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getId(){
		return $this->id;
	}
}

session_start();

$ba = new BloquearAcesso;
$ba->setId($_POST["acesso"]);
$ba->bloquear($ba->getId());

header("Location: ../admin.html");
?>