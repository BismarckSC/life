<?php
include 'conexao.php';

class EditarAlbum {
	protected $nome;
	protected $id;
	protected $nomeCliente;
	
	public function setnome($nome) {
		$this->nome = $nome;
	}
	
	public function setid($id) {
		$this->id = $id;
	}
	
	public function setnomeCliente($nome) {
		$this->nomeCliente = $nome;
	}

	public function getId(){
		return $this->id;
	}

	public function getNomeCliente(){
		return $this->nomeCliente;
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

$ea = new EditarAlbum;
$ea->setnome($_POST["txtnome"]);
$ea->setid($_SESSION["e_album_id"]);
$ea->setnomeCliente($_SESSION["e_album_nome_cliente"]);
$ea->criar();

header("Location: ../editar_album.php?id=".$ea->getId()."&nome=".$ea->getNomeCliente());
?>

