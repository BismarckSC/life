<?php
include 'conexao.php';

class CriarPasta {
	protected $nome;
	protected $id;
	
	public function setnome($nome) {
		$this->nome = $nome;
	}
	
	public function setid($id) {
		$this->id = $id;
	}
	
	public function criar() {
		$con = new Conexao;

		$con->criar();
		$con->selecionar();
		$id = $con->cadpasta($this->nome,$this->id);
		$con->fechar();
		
		mkdir("../uploads/$this->id/$this->nome", 0777);
	}
}

session_start();

$cp = new CriarPasta;
$cp->setnome($_POST["txtnome"]);
$cp->setid($_SESSION["c_album_id"]);
$cp->criar();

header("Location:../criar_pasta.php");
?>

