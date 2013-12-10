<?php
/*
 *	Classe responsavel pela criação de albuns
 */

include 'conexao.php';

class PararTutorial {
	protected $id;
	
	public function setId($id) {
		$this->id = $id;
	}
	
	public function parar() {
		$con = new Conexao;

		$con->criar();
		$con->selecionar();
		$con->executar("UPDATE cliente SET tutorial = 0 WHERE id = '$this->id';");
		$con->fechar();
	}
}

$pt = new PararTutorial;
$pt->setId($_POST["cliente"]);
$pt->parar();

header("Location:../cliente.php");
?>

