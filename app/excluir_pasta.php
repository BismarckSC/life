<?php

include 'conexao.php';

class ExcluirPasta{

	protected $idPasta;
	protected $nomePasta;
	protected $id;
	protected $nome;

	public function setParametros($id){
		$con = new Conexao;
		$con->criar();
		$con->selecionar();
		$con->executar("SELECT c.id, c.nome FROM cliente c, cliente_pasta WHERE $id = id_pasta AND id_cliente = c.id;");
		$rst = $con->proxima();
        $con->fechar();
        $this->id = $rst["id"];
        $this->nome = $rst["nome"];
	}
	
	public function excluirFotos($id){
		$con3 = new Conexao;
		$con3->criar();
		$con3->selecionar();

		$con4 = new Conexao;
		$con4->criar();
		$con4->selecionar();

		$con3->executar("SELECT id FROM pasta_fotos, fotos WHERE $id = id_pasta AND id_foto = id;");
		$qtde = $con3->qtde();
        for($i = 0; $i < $qtde; $i++) {
            $rst = $con3->proxima();
            $con4->executar("DELETE FROM fotos WHERE id = $rst[id];");
        }
        $con3->fechar();
        $con4->fechar();
	}

	public function excluirPasta($id) {
		$con2 = new Conexao;
		$con2->criar();
		$con2->selecionar();
		$con2->executar("DELETE FROM pasta WHERE id = $id;");
		$con2->fechar();
	}

	public function rrmdir($dir) { 
    	if (is_dir($dir)) { 
     		$objects = scandir($dir); 
    		foreach ($objects as $object) { 
    			if ($object != "." && $object != "..") {
        			if (filetype($dir."/".$object) == "dir")
        				$this->rrmdir($dir."/".$object);
        			else
        				unlink($dir."/".$object);
    			} 
    		} 
    		reset($objects); 
    		rmdir($dir); 
		} 
	}

	public function setIdPasta($id){
		$this->idPasta = $id;
	}

	public function getIdPasta(){
		return $this->idPasta;
	}

	public function getId(){
		return $this->id;
	}

	public function getNome(){
		return $this->nome;
	}

	public function setNomePasta($id){
		$con5 = new Conexao;
		$con5->criar();
		$con5->selecionar();
		$con5->executar("SELECT nome FROM pasta WHERE $id = id;");
		$rst = $con5->proxima();
        $con5->fechar();
        $this->nomePasta = $rst["nome"];
	}

	public function getNomePasta(){
        return $this->nomePasta;
	}
}

session_start();

$ep = new ExcluirPasta;
$ep->setIdPasta($_POST["folder"]);
$ep->setParametros($ep->getIdPasta());
$ep->setNomePasta($ep->getIdPasta());
$ep->excluirFotos($ep->getIdPasta());
$ep->excluirPasta($ep->getIdPasta());
$ep->rrmdir("../uploads/".$ep->getId()."/".$ep->getNomePasta());
//$ep->setid($_SESSION["e_album_id"]);
//$ep->excluir();

header("Location: ../editar_album.php?id=".$ep->getId()."&nome=".$ep->getNome());
?>