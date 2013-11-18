<?php

include 'conexao.php';

class ExcluirAlbum{

	protected $id;

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
$ea->excluirPastas($ea->getId());
$ea->excluir($ea->getId());

header("Location: ../admin.html");
?>