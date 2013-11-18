<?php

include 'conexao.php';

class EditarInfos{

	protected $id;
	protected $nome;
	protected $evento;
	protected $descricao;


	public function setId($id){
		$this->id = $id;
	}

	public function getId(){
		return $this->id;
	}

	public function getNome(){
		return $this->nome;
	}


	public function setnome($nome) {
		$this->nome = $nome;
	}
	
	public function getEvento(){
		return $this->evento;
	}

	public function setevento($evento) {
		$this->evento = $evento;
	}

	public function getDescricao(){
		return $this->descricao;
	}
	
	public function setdescricao($descricao) {
		$this->descricao = $descricao;
	}


	public function atualizar($nome, $evento, $descricao, $id) {
		$con = new Conexao;

		$con->criar();
		$con->selecionar();
		$con->executar("UPDATE cliente SET nome = '$nome', evento = '$evento', descricao = '$descricao' WHERE id = $id;");
		$con->fechar();
	}
}

session_start();

$ei = new EditarInfos;
$ei->setId($_POST["idcli"]);
$ei->setnome($_POST["txtnome"]);
$ei->setevento($_POST["txtevento"]);
$ei->setdescricao($_POST["txtdesc"]);
$ei->atualizar($ei->getNome(), $ei->getEvento(), $ei->getDescricao(), $ei->getId());

header("Location: ../editar_album.php?id=".$ei->getId()."&nome=".$ei->getNome());
?>