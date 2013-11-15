<?php
include 'conexao.php';

class Marcar {
	protected $id;
	
	public function setid($id) {
		$this->id = $id;
	}
	
	public function marcar() {
		$con = new Conexao;

		$con->criar();
		$con->selecionar();
		$con->executar("update fotos set selecionada = 1 where id = '$this->id';");
		$con->fechar();
	}
}

$id = $_POST["id"];
$m = new Marcar;
$m->setid($id);
$m->marcar();
?>
