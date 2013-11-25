<?php

include 'conexao.php';

class LiberarAcesso{

	protected $id;
	
	public function liberar($id) {
		$con = new Conexao;
		$con->criar();
		$con->selecionar();
		$con->executar("UPDATE cliente SET acesso = 1 WHERE id = $id;");
		$con->fechar();
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getId(){
		return $this->id;
	}
}

session_start();

$la = new LiberarAcesso;
$la->setId($_POST["acesso"]);
$la->liberar($la->getId());

header("Location: ../admin.html");
?>