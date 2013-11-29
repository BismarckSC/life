<?php
include 'conexao.php';
include 'MailSender.php';
include 'HashCodeGenerator.php';

class AlterarSenha{

	protected $id_cliente;
	protected $senha;
	protected $hash;
	protected $temphash;
	protected $novasenha;
	protected $novohash;

	public function setId($id){
		$this->id_cliente = $id;
	}

	public function setSenha($senha){
		$this->senha = $senha;
	}

	public function setNovaSenha($senha){
		$this->novasenha = $senha;
	}

	public function getTempHash(){
		return $this->temphash;
	}

	public function getHash(){
		return $this->hash;
	}

	public function gerarHash(){
		$hash = new HashCodeGenerator;

		$this->temphash = $hash->generateNewHash($this->senha);
	}

	public function gerarNovoHash(){
		$hash2 = new HashCodeGenerator;

		$this->novohash = $hash2->generateNewHash($this->novasenha);
	}

	public function verificaSenhaAntiga(){
		$con = new Conexao;
		$con->criar();
		$con->selecionar();
		$con->executar("SELECT senha FROM cliente WHERE id = $this->id_cliente;");
		$rst = $con->proxima();
		$this->hash = $rst["senha"];
		$con->fechar();

		// if(strcmp($this->temphash, $this->hash) == 0){
		// 	return true;
		// }
		// else{
		// 	return false;
		// }
	}

	public function atualizarSenha(){
		$con = new Conexao;
		$con->criar();
		$con->selecionar();
		$con->executar("UPDATE cliente SET senha = $this->novohash WHERE id = $this->id_cliente");
		$con->fechar();
	}

}

$as = new AlterarSenha;
$as->setId($_POST["idcli"]);
$as->setSenha($_POST["oldpass"]);
$as->setNovaSenha($_POST["renewpass"]);
$as->gerarHash();
$as->verificaSenhaAntiga();
if(strcmp($as->getTempHash(), $as->getHash()) == 0){
	$as->gerarNovoHash();
	$as->atualizarSenha();
	header("Location: ../alterar_senha_sucesso.html");
}
else{
	header("Location: ../alterar_senha_erro.html");
}

?>