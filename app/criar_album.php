<?php
/*
 *	Classe responsavel pela criação de albuns
 */

include 'conexao.php';

class CriarAlbum {
	protected $nome;
	protected $email;
	protected $senha;
	protected $evento;
	protected $descricao;
	
	public function setnome($nome) {
		$this->nome = $nome;
	}
	
	public function setemail($email) {
		$this->email = $email;
	}
	
	public function setevento($evento) {
		$this->evento = $evento;
	}
	
	public function setdescricao($descricao) {
		$this->descricao = $descricao;
	}
	
	protected function gerarsenha() {
		$alfabeto = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
		$this->senha = "        ";
		for ($i = 0; $i < 8; $i++) {
		    $n = rand(0, count($alfabeto)-1);
		    $this->senha[$i] = $alfabeto[$n];
		}
	}
	
	public function criar() {
		$this->gerarsenha();
		
		$con = new Conexao;

		$con->criar();
		$con->selecionar();
		$id = $con->cadalbum($this->nome,$this->email,$this->senha,$this->evento,$this->descricao);
		$con->fechar();
		
		session_start();
		$_SESSION["c_album_id"] = $id;
		mkdir("../uploads/$id", 0777);
	}
}

$ca = new CriarAlbum;
$ca->setnome($_POST["txtnome"]);
$ca->setemail($_POST["txtemail"]);
$ca->setevento($_POST["txtevento"]);
$ca->setdescricao($_POST["txtdesc"]);
$ca->criar();

header("Location:../criar_pasta.php");
?>
