<?php
include 'conexao.php';
include 'MailSender.php';

class EmailNovoAlbum {
	protected $id;
	protected $nome;
	protected $email;
	protected $senha;
	protected $evento;
	
	public function setId($id){
		$this->id = $id;
	}

	public function setSenha($senha){
		$this->senha = $senha;
	}

	public function recuperarDados(){
		$con = new Conexao;

		$con->criar();
		$con->selecionar();
		//$con->executar("SELECT nome, email, senha, evento FROM cliente WHERE id = $this->id");
		$con->executar("SELECT nome, email, evento FROM cliente WHERE id = $this->id");
		$rst = $con->proxima();
		$con->fechar();

		$this->nome = $rst["nome"];
		$this->email = $rst["email"];
		//$this->senha = $rst["senha"];
		$this->evento = $rst["evento"];
	}

	public function enviarEmail(){
		$email = new MailSender;

		$email->setDestino($this->email);
		$email->setAssunto("Bem-vindo ao Life Triagem de Fotos!");
		$email->setMensagem("Prezado(a) $this->nome,<br><br>As fotos do evento \"$this->evento\" 
			estão disponíveis em nosso sistema de triagem para que sejam escolhidas quais irão 
			compor seu álbum. Acesse nosso sistema em http://triagem.eventoslife.com.br .
			<br><br>Informações de acesso:<br>Nome de usuário: $this->email<br>Senha: $this->senha<br><br>
			Você pode alterar a senha para uma desejada a qualquer momento, assim que acessar nosso site.
			<br><br>Atenciosamente,<br>Life Triagem de Fotos.");
		$email->enviarMensagem();
	}
}

session_start();

$ena = new EmailNovoAlbum;
$ena->setId($_POST["cliente"]);
$ena->setSenha($_SESSION["c_senha"]);
$ena->recuperarDados();
$ena->enviarEmail();

header("Location:../admin.html");
?>

