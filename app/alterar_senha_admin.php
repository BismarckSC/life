<?php
include 'conexao.php';
//include 'MailSender.php';
include 'HashCodeGenerator.php';

class AlterarSenhaAdmin{

	protected $id_admin;
	protected $senha;
	protected $hash;
	protected $temphash;
	protected $novasenha;
	protected $novohash;

	public function setId($id){
		$this->id_admin = $id;
	}

	public function setSenha($senha){
		$this->senha = $senha;
	}

	public function setNovaSenha($senha){
		$this->novasenha = $senha;
	}

	public function getId(){
		return $this->id_admin;
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
		$con->executar("SELECT senha FROM admin WHERE id = $this->id_admin;");
		$rst = $con->proxima();
		$this->hash = $rst["senha"];
		$con->fechar();
	}

	public function atualizarSenha(){
		$con2 = new Conexao;
		$con2->criar();
		$con2->selecionar();
		$con2->executar("UPDATE admin SET senha = '$this->novohash' WHERE id = '$this->id_admin';");
		$con2->fechar();
	}

	public function enviarEmail(){
		$email = new MailSender;

		$emailDest = "";
		$nomeDest = "Administrador";
		$email->setDestino("");
		$email->setAssunto("Life Triagem de Fotos - senha alterada");
		$email->setMensagem("Prezado $nomeDest,<br><br>A senha de sua conta em 
			http://triagem.eventoslife.com.br foi alterada! Confira as novas informações 
			de acesso:<br><br>Nome de usuário: $emailDest<br>Senha: $this->novasenha
			<br><br>Atenciosamente,<br>Life Triagem de Fotos.");
		$email->enviarMensagem();
	}

}

$as = new AlterarSenhaAdmin;
$as->setId($_POST["idadmin"]);
$as->setSenha($_POST["oldpass"]);
$as->setNovaSenha($_POST["renewpass"]);
$as->gerarHash();
$as->verificaSenhaAntiga();

if(strcmp($as->getTempHash(), $as->getHash()) == 0){
	$as->gerarNovoHash();
	$as->atualizarSenha();
	//$as->enviarEmail();
	header("Location: ../alterar_senha_admin_sucesso.html");
}
else{
	header("Location: ../alterar_senha_admin_erro.php");
}

?>