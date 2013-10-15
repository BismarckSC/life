<?php
	session_start();
	include 'app/conexao.php';

	$nome = $_SESSION["user_nome"];
	$uid = $_SESSION["user_id"];
	$id = $_GET["id"];
	$album = $_GET["nome"];

	$con = new Conexao;
	
	$con->criar();
	$con->selecionar();
	$con->executar("select f.nome from fotos f, pasta_fotos p where f.id = p.id_foto and p.id_pasta = '$id';");
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
        <title>Eventos Life - Triagem de fotos</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta name="author" content="Dark Horses" />
        <link rel="shortcut icon" href="../favicon.ico">
        <link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-responsive.min.css" rel="stylesheet"> 
		<link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/style1.css" />
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
            	Seja Bem Vindo <strong><?php echo $nome; ?></strong>! <a href="">(sair)</a>
            </span>
            <div class="clr"></div>
        </div>
        
    	<div id="container">
    		<font size="12">Pasta: <?php echo $album; ?></font>
    		<br>
    		Pagina 1 de 15
    	</div>
    	
		<div id="container">
			<ul id="grid" class="group">
<?php
	$qtde = $con->qtde();
	for($i = 0; $i < $qtde; $i++) {
		$rst = $con->proxima();
?>
				<li>
		            <div class="details">
		            	<h3><?php echo $rst['nome']; ?></h3>
		                <a class="more" href="">marcar</a>
		            </div>
		           <a class="more" href="#imagem<?php echo $i; ?>"><img src="uploads/<?php echo $uid; ?>/<?php echo $album; ?>/<?php echo $rst['nome']; ?>" width="290px"/></a>
		        </li>
<?php
	}
?>
		</ul>
		<ul id="information">
<?php
	$con->executar("select f.nome from fotos f, pasta_fotos p where f.id = p.id_foto and p.id_pasta = '$id';");
	for($i = 0; $i < $qtde; $i++) {
		$rst = $con->proxima();
?>
				<li id="imagem<?php echo $i; ?>">
            	<div>
               		<img src="uploads/<?php echo $uid; ?>/<?php echo $album; ?>/<?php echo $rst['nome']; ?>" />
                    <a href="#" class="close">x</a>
            	</div>
				<span class="backface"></span>
<?php
	}
	$con->fechar();
?>
			</li>
			</ul>
		</div>
		<div class="container span4 offset4">
			<button type="button" class="btn-primary btn-large" onclick="" id="">Anterior</button>
			<button type="button" class="btn-primary btn-large" onclick="" id="">Próxima</button>
		</div>
    </body>
</html>
