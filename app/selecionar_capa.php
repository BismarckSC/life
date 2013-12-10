<?php
include 'conexao.php';

class SelecionarCapa {
	protected $capa;
	protected $cliente;
	
	public function setCapa($cliente,$pasta,$foto) {
		$this->cliente = $cliente;
		$this->capa = $pasta . "/" . $foto;
	}
	
	public function selecionar() {
		$capa = $this->capa;
		$id = $this->cliente;
	
		$con = new Conexao;
		$con->criar();
		$con->selecionar();
		$q = "UPDATE cliente SET capa = '$capa' WHERE id = $id;";
		$con->executar($q);
		$con->fechar();
	}
}



$sc = new SelecionarCapa;
$sc->setCapa($_GET["id"],$_GET["pasta"],$_GET["foto"]);
$sc->selecionar();

header("Location:../pendentes.php");
?>
