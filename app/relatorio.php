<?php

include 'conexao.php';

class Relatorio{

	protected $id;
	protected $nome;
	protected $path;
	protected $my_file;

	public function setId($id){
		$this->id = $id;
	}

	public function getId(){
		return $this->id;
	}

	public function getNome(){
		return $this->nome;
	}


	public function setnome($nome) {
		$this->nome = $nome;
	}

	public function getPath(){
		return $this->path;
	}

	public function getFile(){
		return $this->my_file;
	}

	public function gerarRelatorio($id) {
		$this->path = "../relatorios/".$id;
		if (!file_exists($this->path)) {
    		mkdir($this->path, 0777, true);
		}
		//create
		$this->my_file = $this->path."/".$id.".txt";
		$handle = fopen($this->my_file, 'w') or die('Cannot open file:  '.$this->my_file); //implicitly creates file

		$con = new Conexao;
		$con->criar();
		$con->selecionar();
		$con->executar("SELECT f.nome, p.id_pasta FROM fotos f, pasta_fotos p, cliente_pasta c WHERE f.selecionada = 1 AND f.excluida = 0 AND f.id = p.id_foto AND p.id_pasta = c.id_pasta AND c.id_cliente = $id;");
		$qtde = $con->qtde();
        for($i = 0; $i < $qtde; $i++) {
            $rst = $con->proxima();
			//write
			$data = "Pasta: ".$rst["id_pasta"]." Foto: ".$rst["nome"]."\n";
			fwrite($handle, $data);
		}

		//close
		fclose($handle);
		$con->fechar();
	}
}

session_start();

$r = new Relatorio;
$r->setId($_POST["relatorio"]);
$r->setnome($_SESSION["e_album_nome_cliente"]);
$r->gerarRelatorio($r->getId());

header("Location: down_rel.php?file=".$r->getFile());
//header("Location: ../final.php?id=".$r->getId()."&nome=".$r->getNome());

?>