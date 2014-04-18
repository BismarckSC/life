#!/usr/local/bin/php -q
<?php

include 'conexao.php';
include 'MailSender.php';

class CriarAlbum {
	public function enviar60() {
		$con = new Conexao;
		$con->criar();
		$con->selecionar();
		$con->executar("select c.id, c.nome, c.email, TO_DAYS(NOW()) - TO_DAYS(c.data_cadastro) dias from cliente c, dias d where c.acesso = 1 and c.id = d.id and d.d60 = 0 and TO_DAYS(NOW()) - TO_DAYS(c.data_cadastro) >= 30;");
		$qtde = $con->qtde();
		for($i = 0; $i < $qtde; $i++) {
			$rst = $con->proxima();
			
			$prazo = 90 - $rst["dias"];
			
			$email = new MailSender;

			$email->setDestino($rst["email"]);
			$email->setAssunto("Life Triagem de Fotos!");
			$email->setMensagem("Prezado(a) ".$rst["nome"].",<br><br>
				Informamos que você tem o prazo de ".$prazo." dias para concluir
				a sua triagem de fotos, fique atento.
				<br><br>Atenciosamente,<br>Life Triagem de Fotos.
				<br>http://triagem.eventoslife.com.br");
			$email->enviarMensagem();
			
			$con1 = new Conexao;
			$con1->criar();
			$con1->selecionar();
			$con1->executar("update dias set d60 = 1 where id = ".$rst["id"].";");
			$con1->fechar();
		}
		$con->fechar();
	}
	
	public function enviar30() {
		$con = new Conexao;
		$con->criar();
		$con->selecionar();
		$con->executar("select c.id, c.nome, c.email, TO_DAYS(NOW()) - TO_DAYS(c.data_cadastro) dias from cliente c, dias d where c.acesso = 1 and c.id = d.id and d.d30 = 0 and TO_DAYS(NOW()) - TO_DAYS(c.data_cadastro) >= 60;");
		$qtde = $con->qtde();
		for($i = 0; $i < $qtde; $i++) {
			$rst = $con->proxima();
			
			$prazo = 90 - $rst["dias"];
			
			$email = new MailSender;

			$email->setDestino($rst["email"]);
			$email->setAssunto("Life Triagem de Fotos!");
			$email->setMensagem("Prezado(a) ".$rst["nome"].",<br><br>
				Informamos que você tem o prazo de ".$prazo." dias para concluir
				a sua triagem de fotos, fique atento.
				<br><br>Atenciosamente,<br>Life Triagem de Fotos.
				<br>http://triagem.eventoslife.com.br");
			$email->enviarMensagem();
			
			$con1 = new Conexao;
			$con1->criar();
			$con1->selecionar();
			$con1->executar("update dias set d30 = 1 where id = ".$rst["id"].";");
			$con1->fechar();
		}
		$con->fechar();
	}
	
	public function enviar20() {
		$con = new Conexao;
		$con->criar();
		$con->selecionar();
		$con->executar("select c.id, c.nome, c.email, TO_DAYS(NOW()) - TO_DAYS(c.data_cadastro) dias from cliente c, dias d where c.acesso = 1 and c.id = d.id and d.d20 = 0 and TO_DAYS(NOW()) - TO_DAYS(c.data_cadastro) >= 70;");
		$qtde = $con->qtde();
		for($i = 0; $i < $qtde; $i++) {
			$rst = $con->proxima();
			
			$prazo = 90 - $rst["dias"];
			
			$email = new MailSender;

			$email->setDestino($rst["email"]);
			$email->setAssunto("Life Triagem de Fotos!");
			$email->setMensagem("Prezado(a) ".$rst["nome"].",<br><br>
				Informamos que você tem o prazo de ".$prazo." dias para concluir
				a sua triagem de fotos, fique atento.
				<br><br>Atenciosamente,<br>Life Triagem de Fotos.
				<br>http://triagem.eventoslife.com.br");
			$email->enviarMensagem();
			
			$con1 = new Conexao;
			$con1->criar();
			$con1->selecionar();
			$con1->executar("update dias set d20 = 1 where id = ".$rst["id"].";");
			$con1->fechar();
		}
		$con->fechar();
	}
	
	public function enviar10() {
		$con = new Conexao;
		$con->criar();
		$con->selecionar();
		$con->executar("select c.id, c.nome, c.email, TO_DAYS(NOW()) - TO_DAYS(c.data_cadastro) dias from cliente c, dias d where c.acesso = 1 and c.id = d.id and d.d10 = 0 and TO_DAYS(NOW()) - TO_DAYS(c.data_cadastro) >= 80;");
		$qtde = $con->qtde();
		for($i = 0; $i < $qtde; $i++) {
			$rst = $con->proxima();
			
			$prazo = 90 - $rst["dias"];
			
			$email = new MailSender;

			$email->setDestino($rst["email"]);
			$email->setAssunto("Life Triagem de Fotos!");
			$email->setMensagem("Prezado(a) ".$rst["nome"].",<br><br>
				Informamos que você tem o prazo de ".$prazo." dias para concluir
				a sua triagem de fotos, fique atento.
				<br><br>Atenciosamente,<br>Life Triagem de Fotos.
				<br>http://triagem.eventoslife.com.br");
			$email->enviarMensagem();
			
			$con1 = new Conexao;
			$con1->criar();
			$con1->selecionar();
			$con1->executar("update dias set d10 = 1 where id = ".$rst["id"].";");
			$con1->fechar();
		}
		$con->fechar();
	}
	
	public function enviar05() {
		$con = new Conexao;
		$con->criar();
		$con->selecionar();
		$con->executar("select c.id, c.nome, c.email, TO_DAYS(NOW()) - TO_DAYS(c.data_cadastro) dias from cliente c, dias d where c.acesso = 1 and c.id = d.id and d.d05 = 0 and TO_DAYS(NOW()) - TO_DAYS(c.data_cadastro) >= 85;");
		$qtde = $con->qtde();
		for($i = 0; $i < $qtde; $i++) {
			$rst = $con->proxima();
			
			$prazo = 90 - $rst["dias"];
			
			$email = new MailSender;

			$email->setDestino($rst["email"]);
			$email->setAssunto("Life Triagem de Fotos!");
			$email->setMensagem("Prezado(a) ".$rst["nome"].",<br><br>
				Informamos que você tem o prazo de ".$prazo." dias para concluir
				a sua triagem de fotos, fique atento.
				<br><br>Atenciosamente,<br>Life Triagem de Fotos.
				<br>http://triagem.eventoslife.com.br");
			$email->enviarMensagem();
			
			$con1 = new Conexao;
			$con1->criar();
			$con1->selecionar();
			$con1->executar("update dias set d05 = 1 where id = ".$rst["id"].";");
			$con1->fechar();
		}
		$con->fechar();
	}
	
	public function enviar01() {
		$con = new Conexao;
		$con->criar();
		$con->selecionar();
		$con->executar("select c.id, c.nome, c.email, TO_DAYS(NOW()) - TO_DAYS(c.data_cadastro) dias from cliente c, dias d where c.acesso = 1 and c.id = d.id and d.d01 = 0 and TO_DAYS(NOW()) - TO_DAYS(c.data_cadastro) >= 89;");
		$qtde = $con->qtde();
		for($i = 0; $i < $qtde; $i++) {
			$rst = $con->proxima();
			
			$prazo = 90 - $rst["dias"];
			
			$email = new MailSender;

			$email->setDestino($rst["email"]);
			$email->setAssunto("Life Triagem de Fotos!");
			$email->setMensagem("Prezado(a) ".$rst["nome"].",<br><br>
				Informamos que você tem o prazo de ".$prazo." dia para concluir
				a sua triagem de fotos, fique atento.
				<br><br>Atenciosamente,<br>Life Triagem de Fotos.
				<br>http://triagem.eventoslife.com.br");
			$email->enviarMensagem();
			
			$con1 = new Conexao;
			$con1->criar();
			$con1->selecionar();
			$con1->executar("update dias set d01 = 1 where id = ".$rst["id"].";");
			$con1->fechar();
		}
		$con->fechar();
	}
	
	public function enviar00() {
		$con = new Conexao;
		$con->criar();
		$con->selecionar();
		$con->executar("select c.id, c.nome, c.email, TO_DAYS(NOW()) - TO_DAYS(c.data_cadastro) dias from cliente c, dias d where c.acesso = 1 and c.id = d.id and d.d00 = 0 and TO_DAYS(NOW()) - TO_DAYS(c.data_cadastro) >= 90;");
		$qtde = $con->qtde();
		for($i = 0; $i < $qtde; $i++) {
			$rst = $con->proxima();
			
			$prazo = 90 - $rst["dias"];
			
			$email = new MailSender;

			$email->setDestino($rst["email"]);
			$email->setAssunto("Life Triagem de Fotos!");
			$email->setMensagem("Prezado(a) ".$rst["nome"].",<br><br>
				Informamos que o seu prazo de triagem terminou e seu acesso foi bloqueado.
				<br><br>Atenciosamente,<br>Life Triagem de Fotos.
				<br>http://triagem.eventoslife.com.br");
			$email->enviarMensagem();
			
			$con1 = new Conexao;
			$con1->criar();
			$con1->selecionar();
			$con1->executar("update dias set d00 = 1 where id = ".$rst["id"].";");
			$con1->fechar();
			
			$con1 = new Conexao;
			$con1->criar();
			$con1->selecionar();
			$con1->executar("UPDATE cliente SET acesso = 0 WHERE id = ".$rst["id"].";");
			$con1->fechar();
		}
		$con->fechar();
	}
	
	public function enviarTodas() {
		$this->enviar60();
		$this->enviar30();
		$this->enviar20();
		$this->enviar10();
		$this->enviar05();
		$this->enviar01();
		$this->enviar00();
	}
}

$ca = new CriarAlbum;
$ca->enviarTodas();

header("Location: ../admin.html");
?>
