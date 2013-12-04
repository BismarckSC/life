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

	public function getId(){
		return $this->id_cliente;
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
		$con2 = new Conexao;
		$con2->criar();
		$con2->selecionar();
		$con2->executar("UPDATE cliente SET senha = '$this->novohash' WHERE id = '$this->id_cliente';");
		$con2->fechar();
	}

	public function enviarEmail(){
		$con3 = new Conexao;
		$email = new MailSender;
		
		$con3->criar();
		$con3->selecionar();
		$con3->executar("SELECT nome, email FROM cliente WHERE id = '$this->id_cliente';");
		$rst3 = $con3->proxima();
		$con3->fechar();

		$emailDest = (string)$rst3["email"];
		$nomeDest = (string)$rst3["nome"];
		$email->setDestino($emailDest);
		$email->setAssunto("Life Triagem de Fotos - senha alterada");
		$email->setMensagem("Prezado(a) $nomeDest,<br><br>A senha de sua conta em 
			http://triagem.eventoslife.com.br foi alterada! Confira as novas informações 
			de acesso:<br><br>Nome de usuário: $emailDest<br>Senha: $this->novasenha
			<br><br>Atenciosamente,<br>Life Triagem de Fotos.");
		$email->enviarMensagem();
	}

}

$as = new AlterarSenha;
$as->setId($_POST["idcli"]);
$as->setSenha($_POST["oldpass"]);
$as->setNovaSenha($_POST["renewpass"]);
$as->gerarHash();
$as->verificaSenhaAntiga();
//header("Location: ../teste.php?id=".$as->getId()."&um=".$as->getTempHash()."&dois=".$as->getHash());
//header("Location: ../editar_album.php?id=".$ea->getId()."&nome=".$ea->getNomeCliente());

if(strcmp($as->getTempHash(), $as->getHash()) == 0){
	$as->gerarNovoHash();
	$as->atualizarSenha();
	$as->enviarEmail();
	header("Location: ../alterar_senha_sucesso.html");
}
else{
	header("Location: ../alterar_senha_erro.php");
}

?>