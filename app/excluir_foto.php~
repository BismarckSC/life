<?php
include 'conexao.php';

class Marcar {
	protected $id;
	
	public function setid($id) {
		$this->id = $id;
	}
	
	public function excluir() {
		$con1 = new Conexao;
		$con2 = new Conexao;
		
		$con1->criar();
		$con1->selecionar();
		$con1->executar("select f.nome nome_foto, p.nome nome_pasta, c.id usuario_id from fotos f, pasta_fotos pf, pasta p, cliente_pasta cp, cliente c where f.id = '$this->id' and f.id = pf.id_foto and pf.id_pasta = p.id and cp.id_pasta = p.id and cp.id_cliente = c.id;");
		$rst = $con1->proxima();
		$con1->fechar();
		
		$uid = $rst["usuario_id"];
		$pasta = $rst["nome_pasta"];
		$nome = $rst["nome_foto"]; 
		
		
		unlink("../uploads/$uid/$pasta/$nome");

		$con2->criar();
		$con2->selecionar();
		$con2->executar("delete from fotos where id = '$this->id';");
		$con2->fechar();
	}
}

$id = $_POST["id"];
$m = new Marcar;
$m->setid($id);
$m->excluir();
?>
