<?php
	session_start();
	include 'app/conexao.php';

	$id = $_GET["id"];
    $nome = $_GET["nome"];
    $pagina = $_GET["pag"];
	
	$limite = 15;
	$off = ($pagina * $limite) - $limite;

	$con = new Conexao;
	$con->criar();
	$con->selecionar();
	
	$con->executar("select f.nome, f.id, f.selecionada from fotos f, pasta_fotos p, cliente_pasta cp where f.excluida <> 1 and f.id = p.id_foto and p.id_pasta = cp.id_pasta and cp.id_cliente = $id");
	$qtde = $con->qtde();
	$totalpaginas = ceil($qtde/$limite);

	$q = "select f.nome, f.id, f.selecionada, p2.nome pasta from fotos f, pasta_fotos p, pasta p2, cliente_pasta cp where f.excluida <> 1 and f.id = p.id_foto and p.id_pasta = cp.id_pasta and cp.id_pasta = p2.id and cp.id_cliente = $id limit $off,$limite;";
	$con->executar($q);
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
		
		<script src="http://code.jquery.com/jquery-latest.js"></script>
		
    </head>
    <body>
    	<div class="codrops-top">
            <a href="admin.html">
                <strong>Inicio</strong>
            </a>
            <span class="right">
            	Seja Bem-Vindo <strong>ADMINISTRADOR</strong>! <a href="app/logout.php">sair</a>
            </span>
            <div class="clr"></div>
        </div>
        
    	<div class="container">
            <h1 id="logo">
            <img src="images/life_logo.png"/>
            </h1>
        </div>

        <div id="container">
            <h2 class="title"><span>Sistema de Triagem de Fotos</span></h2>
    		<h2 class="title"><span>Seleção de capa para "<?php echo $nome; ?>"</span></h2>
    	</div>
    	
		<div id="container">
			<ul id="grid" class="group">
<?php
	$qtde = $con->qtde();
	for($i = 0; $i < $qtde; $i++) {
		$rst = $con->proxima();
		$album = $rst["pasta"];
?>
				<li>
		            <div class="details" id="div<?php echo $rst['id'] ?>">
		            	<h3><?php echo $rst['nome']; ?></h3>
		            	<form method="post" action="app/selecionar_capa.php">
		            	<input type="hidden" name="id" value="<?php echo $id; ?>" />
		            	<input type="hidden" name="pasta" value="<?php echo $album; ?>" />
		            	<input type="hidden" name="foto" value="<?php echo $rst['nome']; ?>" />
		                <button type="submit" class="more">selecionar</button>
		                </form>
		            </div>
		           <a class="more" href=""><img src="uploads/<?php echo $id; ?>/<?php echo $album; ?>/<?php echo $rst['nome']; ?>" width="290px"/></a>
		        </li>
<?php
	}
?>
		</ul>
		<ul id="information">
<?php
	$con->fechar();
?>
			
			</ul>
		</div>
		<div class="container">
		<!--<div class="container" span4 offset4> -->
			<?php if($totalpaginas > 1){ ?>
			<br>
    		Pagina <?php echo $pagina; ?> de <?php echo $totalpaginas; ?>
    		<br><br>
			<?php if($pagina > 1) { ?>
			<a type="button" class="btn" href="selec_capa.php?id=<?php echo $id; ?>&nome=<?php echo $nome; ?>&pag=<?php echo $pagina - 1?>">Anterior</a>
			<?php } else {?>
			<a type="button" class="btn" enable="false">Anterior</a>
			<?php }
			if($pagina < $totalpaginas) { ?>
			<a type="button" class="btn" href="selec_capa.php?id=<?php echo $id; ?>&nome=<?php echo $nome; ?>&pag=<?php echo $pagina + 1?>">Próxima</a>
			<?php } else {?>
			<a type="button" class="btn" enable="false">Próxima</a>
			<?php } ?>
			<?php } ?>
		</div>
		<br>
        <div class="container">
            <a href="editar_album.php?id=<?php echo $id; ?>&nome=<?php echo $nome; ?>" class="btn btn-default">Voltar</a>
        </div>
    </body>
</html>
