<?php
/*
 *	Classe responsavel pela criação de albuns
 */

include 'conexao.php';
include 'RandomKeyGenerator.php';
include 'HashCodeGenerator.php';

class CriarAlbum {
	protected $nome;
	protected $email;
	protected $senha;
	protected $hash;
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

	public function gerarsenha(){
		$senha = new RandomKeyGenerator;

		$this->senha = $senha->generateNewKey();
	}

	public function gerarHash(){
		$hash = new HashCodeGenerator;

		$this->hash = $hash->generateNewHash($this->senha);
	}
	
	public function criar() {
		$this->gerarsenha();
		$this->gerarHash();
		
		$con = new Conexao;

		$con->criar();
		$con->selecionar();
		$id = $con->cadalbum($this->nome,$this->email,$this->hash,$this->evento,$this->descricao);
		$con->fechar();
		
		session_start();
		$_SESSION["c_album_id"] = $id;
		mkdir("../uploads/$id", 0777);
		$_SESSION["c_senha"] = $this->senha;
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

