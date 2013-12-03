<?php
/*
 *	Classe responsavel pela criação de albuns
 */

include 'conexao.php';
include 'MailSender.php';
include 'RandomKeyGenerator.php';
include 'HashCodeGenerator.php';

class CriarAlbum {
	protected $nome;
	protected $email;
	protected $senha;
	protected $hash;
	protected $evento;
	protected $numfotos;
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

	public function setnumfotos($fotos){
		$this->numfotos = $fotos;
	}
	
	public function setdescricao($descricao) {
		$this->descricao = $descricao;
	}
	
	// protected function gerarsenha() {
	// 	$alfabeto = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
	// 	$this->senha = "        ";
	// 	for ($i = 0; $i < 8; $i++) {
	// 	    $n = rand(0, count($alfabeto)-1);
	// 	    $this->senha[$i] = $alfabeto[$n];
	// 	}
	// }

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
		$id = $con->cadalbum($this->nome,$this->email,$this->hash,$this->evento,$this->descricao,$this->numfotos);
		$con->fechar();
		
		session_start();
		$_SESSION["c_album_id"] = $id;
		mkdir("../uploads/$id", 0777);
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

$ca = new CriarAlbum;
$ca->setnome($_POST["txtnome"]);
$ca->setemail($_POST["txtemail"]);
$ca->setevento($_POST["txtevento"]);
$ca->setnumfotos($_POST["numfotos"]);
$ca->setdescricao($_POST["txtdesc"]);
$ca->criar();
$ca->enviarEmail();

header("Location:../criar_pasta.php");
?>

