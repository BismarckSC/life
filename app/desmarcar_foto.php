<?php
include 'conexao.php';

class DesMarcar {
	protected $id;
	
	public function setid($id) {
		$this->id = $id;
	}
	
	public function desmarcar() {
		$con = new Conexao;

		$con->criar();
		$con->selecionar();
		$con->executar("update fotos set selecionada = 0 where id = '$this->id';");
		$con->fechar();
	}
}

$id = $_POST["id"];
$m = new DesMarcar;
$m->setid($id);
$m->desmarcar();
?>
