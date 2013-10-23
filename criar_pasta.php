<?php
	include 'app/conexao.php';

	session_start();
	$id = $_SESSION["c_album_id"];
	
	$con = new Conexao;
	
	$con->criar();
	$con->selecionar();
	$con->executar("SELECT p.id, p.nome FROM cliente_pasta c, pasta p WHERE c.id_pasta = p.id AND c.id_cliente = '$id';");
?>

<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie ie6 no-js" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" lang="en"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" lang="en"><!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <title>Eventos Life - Triagem de fotos (Admin)</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta name="author" content="Dark Horses" />
        <link rel="shortcut icon" href="../favicon.ico">
        <link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-responsive.min.css" rel="stylesheet"> 
		<link rel="stylesheet" type="text/css" href="css/demo.css" />
		<script type="text/javascript" src="js/modernizr.custom.86080.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="css/reset.css" media="screen" />
		<link rel="stylesheet" href="css/style.css" media="screen" />
		<link rel="stylesheet" href="css/css3_3d.css" media="screen" />
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/modernizr.js"></script>

		<script>
			if (!Modernizr.csstransforms) {
				$(document).ready(function(){
					$(".close").text("Back to top");
				});
			}
		</script>
    </head>
    <body>
    	<div class="codrops-top">
            <a href="">
                <strong>Inicio</strong>
            </a>
            <span class="right">
            	Seja Bem Vindo <strong>ADMISTRADOR</strong>! <a href="">(sair)</a>
            </span>
            <div class="clr"></div>
        </div>
        
        <div id="container">
        	<h2 class="title">Eventos Life <span><br>Sistema de Triagem de Fotos<br> Criação dos álbuns</span></h2>
        
    	</div>
        
        </br></br>
        
        <div id="container">
    		<label>Pastas:</label>
<?php
	$qtde = $con->qtde();
	if($qtde > 0) {
		for($i = 0; $i < $qtde; $i++) {
			$rst = $con->proxima();
?>
    		<form class="form-horizontal" role="form">
				<?php echo $rst["nome"]; ?><a href="adicionar_fotos.php?id=<?php echo $rst['id']; ?>" class="btn btn-default">Adicionar Fotos</a>
			</form>
<?php
		}
	}
	$con->fechar();
?>
		</div>
        <div id="container">
			<form class="form-horizontal" role="form" method="post" action="app/criar_pasta.php">
				<input type="text" class="form-control" name="txtnome" placeholder="Insira o nome">
				<button type="submit" class="btn btn-default">Criar Pasta</button>
			</form>	
			
			<a href="admin.html" class="btn btn-default">Finalizar</a>
        </div>
    </body>
</html>
