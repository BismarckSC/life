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
	
	$con1 = new Conexao;
	
	$con1->criar();
	$con1->selecionar();
	$con1->executar("select count(*) total, sum(f.selecionada) soma from fotos f, cliente_pasta cp, pasta_fotos pf where cp.id_cliente = '$id' and cp.id_pasta = pf.id_pasta and pf.id_foto = f.id and f.excluida = 0;");
	$con1_rst = $con1->proxima();
	$con1->fechar();
	
	$total_fotos = $con1_rst["total"];
	$fotos_selecionadas = $con1_rst["soma"];
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

			var userAgent = navigator.userAgent.toLowerCase();
			if( userAgent.search(/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i)!= -1 )
				location.href="cliente_mobile.php";
		</script>
    </head>
    <body>
    	<div class="codrops-top">
            <a href="">
                <strong>Inicio</strong>
            </a>
            <span class="right">
            	<strong style="font-weight: bold;">Seja Bem-Vindo(a) <?php echo $nome; ?>! </strong><a href="alterar_senha.php?id=<?php echo $id; ?>&nome=<?php echo $nome; ?>">alterar senha</a>|<a href="app/logout.php">sair</a>
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
    		<h2 class="title"><span>Pastas do álbum do evento "<?php echo $rst["evento"]; ?>"</span></h2>
    		<!--<font size="8"><span>Evento:</span><?php echo $rst["evento"]; ?></font>-->
    		<p style="width: 610px; padding: 20px 30px 0 30px; margin: 0 auto; text-align: center;"><?php echo $rst["descricao"]; ?></p>
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
		
		$album_id = $rst['id'];
		
		$con3 = new Conexao;
	
		$con3->criar();
		$con3->selecionar();
		$con3->executar("select f.nome from pasta_fotos pf, fotos f where pf.id_foto = f.id and pf.id_pasta = $album_id limit 1;");
		$rst_con3 = $con3->proxima();
?>
				<li>
		            <div class="details">
		            	<h3><?php $name = explode("-", $rst["nome"], 2); echo $name[1]; ?></h3>
		            </div>
		           <a class="more" href="album.php?id=<?php echo $rst['id']; ?>&nome=<?php echo $rst['nome']; ?>&pag=1"><img src="uploads/<?php echo $id; ?>/<?php echo $rst["nome"]; ?>/<?php echo $rst_con3["nome"]; ?>" width="290px"/></a>
		        </li>
<?php
		$con3->fechar();
	}
	$con2->fechar();
?>
			</ul>
		</div>

		<div id="container">
    		Fotos selecionadas: <?php echo $fotos_selecionadas; ?> de <?php echo $total_fotos; ?>
    		<br>
    		<br>
    	</div>

		<div class="container">
			<a class="btn" href="app/triagem.php?operacao=2">Resetar triagem</a>
			<a class="btn" href="app/triagem.php?operacao=1">Efetuar triagem</a>
			<a href="confirmar_final.php" class="btn">Finalizar triagem</a>
		</div>
    </body>
</html>