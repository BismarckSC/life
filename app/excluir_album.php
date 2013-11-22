<?php

include 'conexao.php';

class ExcluirAlbum{

	protected $id;

	public function excluirFotos($id){
		$con4 = new Conexao;
		$con4->criar();
		$con4->selecionar();

		$con5 = new Conexao;
		$con5->criar();
		$con5->selecionar();

		$con4->executar("SELECT f.id FROM cliente_pasta c, pasta_fotos p, fotos f WHERE $id = c.id_cliente AND c.id_pasta = p.id_pasta AND p.id_foto = f.id;");
		$qtde2 = $con4->qtde();
        for($i = 0; $i < $qtde2; $i++) {
            $rst2 = $con4->proxima();
            $con5->executar("DELETE FROM fotos WHERE id = $rst2[id];");
        }
        $con4->fechar();
        $con5->fechar();
	}

	public function excluirPastas($id){
		$con = new Conexao;
		$con->criar();
		$con->selecionar();

		$con2 = new Conexao;
		$con2->criar();
		$con2->selecionar();

		$con->executar("SELECT id FROM cliente_pasta, pasta WHERE $id = id_cliente AND id_pasta = id;");
		$qtde = $con->qtde();
        for($i = 0; $i < $qtde; $i++) {
            $rst = $con->proxima();
            $con2->executar("DELETE FROM pasta WHERE id = $rst[id];");
        }
        $con->fechar();
        $con2->fechar();
	}
	
	public function excluir($id) {
		$con3 = new Conexao;
		$con3->criar();
		$con3->selecionar();
		$con3->executar("DELETE FROM cliente WHERE id = $id;");
		$con3->fechar;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getId(){
		return $this->id;
	}
}

session_start();

$ea = new ExcluirAlbum;
$ea->setId($_POST["album"]);
$ea->excluirFotos($ea->getId());
$ea->excluirPastas($ea->getId());
$ea->excluir($ea->getId());

header("Location: ../admin.html");
?>