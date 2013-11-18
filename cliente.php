<?php
	session_start();
	include 'app/conexao.php';

	$nome = $_SESSION["user_nome"];
	$id = $_SESSION["user_id"];

	$con = new Conexao;
	
	$con->criar();
	$con->selecionar();
	$con->executar("SELECT * FROM cliente WHERE id = '$id';");
	$rst = $con->proxima();
	$con->fechar();
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
        <title>Life - Triagem de fotos</title>
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
            	Seja Bem Vindo(a) <strong><?php echo $nome; ?></strong>! <a href="">alterar senha</a>|<a href="">sair</a>
            </span>
            <div class="clr"></div>
        </div>
        
        <div class="container">
            <h1 id="logo">
            <a href="cliente.php">
            <img src="images/life_logo.png"/>
        	</a>
            </h1>
        </div>

        <div id="container">
            <h2 class="title"><span>Sistema de Triagem de Fotos</span></h2>
    		<h2 class="title"><span>- Evento: <?php echo $rst["evento"]; ?> -</span></h2>
    		<!--<font size="8"><span>Evento:</span><?php echo $rst["evento"]; ?></font>-->
    		<p style="width: 610px; padding: 20px 30px 0 30px; margin: 0 auto; text-align: center;"><?php echo $rst["descricao"]; ?></p>
    	</div>

    	<div id="container">
    		<br>
    		<font size="8">Pastas</font>
    	</div>
    	
		<div id="container">
			<ul id="grid" class="group">
<?php
	$con2 = new Conexao;
	
	$con2->criar();
	$con2->selecionar();
	$con2->executar("select p.id, p.nome from cliente c, pasta p, cliente_pasta cp where c.id = cp.id_cliente and p.id = cp.id_pasta and c.id = '$id';");
	$qtde = $con2->qtde();
	for($i = 0; $i < $qtde; $i++) {
		$rst = $con2->proxima();
?>
				<li>
		            <div class="details">
		            	<h3><?php echo $rst["nome"]; ?></h3>
		            </div>
		           <a class="more" href="album.php?id=<?php echo $rst['id']; ?>&nome=<?php echo $rst['nome']; ?>&pag=1"><img src="images/pasta.png" width="290px"/></a>
		        </li>
<?php
	}
	$con2->fechar();
?>
			</ul>
		</div>

		<div id="container">
    		Fotos selecionadas: 200 de 500
    		<br>
    		<br>
    	</div>

		<div class="container span4 offset4">
			<button type="button" class="btn" onclick="" id="">Efetuar Triagem</button>
			<button type="button" class="btn" onclick="" id="">Finalizar Triagem</button>
		</div>
    </body>
</html>
