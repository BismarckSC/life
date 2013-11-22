<?php
	session_start();
	include 'app/conexao.php';

	$nome = $_SESSION["user_nome"];
	$uid = $_SESSION["user_id"];
	$id = $_GET["id"];
	$album = $_GET["nome"];
	$pagina = $_GET["pag"];
	
	$limite = 15;
	$off = ($pagina * $limite) - $limite;

	$con = new Conexao;
	$con->criar();
	$con->selecionar();
	
	$con->executar("select f.nome, f.id, f.selecionada from fotos f, pasta_fotos p where f.id = p.id_foto and p.id_pasta = $id");
	$qtde = $con->qtde();
	$totalpaginas = ceil($qtde/$limite);

	$q = "select f.nome, f.id, f.selecionada from fotos f, pasta_fotos p where f.id = p.id_foto and p.id_pasta = $id limit $off,$limite;";
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
 
		<script>
		function SubmitForm(num) {
			$.post("app/marcar_foto.php", {id:num});
			
			obj = "div" + num;
			document.getElementById(obj).setAttribute("class", "details1");
			
			obj1 = "mar" + num;
			obj2 = "desmar" + num;
			document.getElementById(obj1).setAttribute("style", "display:none;");
			document.getElementById(obj2).setAttribute("style", "");
			
			obj11 = "mar1" + num;
			obj21 = "desmar1" + num;
			document.getElementById(obj11).setAttribute("style", "display:none;");
			document.getElementById(obj21).setAttribute("style", "");
		}
		
		function SubmitForm2(num) {
			$.post("app/desmarcar_foto.php", {id:num});
			
			obj = "div" + num;
			document.getElementById(obj).setAttribute("class", "details");
			
			obj1 = "mar" + num;
			obj2 = "desmar" + num;
			document.getElementById(obj1).setAttribute("style", "");
			document.getElementById(obj2).setAttribute("style", "display:none;");
			
			obj11 = "mar1" + num;
			obj21 = "desmar1" + num;
			document.getElementById(obj11).setAttribute("style", "");
			document.getElementById(obj21).setAttribute("style", "display:none;");
		}
		</script>
		
    </head>
    <body>
    	<div class="codrops-top">
            <a href="">
                <strong>Inicio</strong>
            </a>
            <span class="right">
            	Seja Bem Vindo(a) <strong><?php echo $nome; ?></strong>! <a href="">(sair)</a>
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
    		<h2 class="title"><span>Fotos da pasta "<?php echo $album; ?>"</span></h2>
    		<!--<br>
    		Pagina <?php echo $pagina; ?> de <?php echo $totalpaginas + 1; ?> -->
    	</div>
    	
		<div id="container">
			<ul id="grid" class="group">
<?php
	$qtde = $con->qtde();
	for($i = 0; $i < $qtde; $i++) {
		$rst = $con->proxima();
?>
				<li>
				<?php
					if($rst['selecionada'] == 0) {
				?>
		            <div class="details" id="div<?php echo $rst['id'] ?>">
		            	<h3><?php echo $rst['nome']; ?></h3>
		                <a class="more" id="mar<?php echo $rst['id'] ?>" onclick="SubmitForm(<?php echo $rst['id'] ?>)">marcar</a>
		                <a class="more" id="desmar<?php echo $rst['id'] ?>" style="display:none;" onclick="SubmitForm2(<?php echo $rst['id'] ?>)">desmarcar</a>
		            </div>
		        <?php
					} else {
				?>
					<div class="details1" id="div<?php echo $rst['id'] ?>">
		            	<h3><?php echo $rst['nome']; ?></h3>
		            	<a class="more" id="mar<?php echo $rst['id'] ?>" style="display:none;" onclick="SubmitForm(<?php echo $rst['id'] ?>)">marcar</a>
		                <a class="more" id="desmar<?php echo $rst['id'] ?>" onclick="SubmitForm2(<?php echo $rst['id'] ?>)">desmarcar</a>
		            </div>
				<?php
					}
				?>
		           <a class="more" href="#imagem<?php echo $i; ?>"><img src="uploads/<?php echo $uid; ?>/<?php echo $album; ?>/<?php echo $rst['nome']; ?>" width="290px"/></a>
		        </li>
<?php
	}
?>
		</ul>
		<ul id="information">
<?php
	$con->executar($q);
	for($i = 0; $i < $qtde; $i++) {
		$rst = $con->proxima();
?>
				<li id="imagem<?php echo $i; ?>">
            	<div>
               		<img src="uploads/<?php echo $uid; ?>/<?php echo $album; ?>/<?php echo $rst['nome']; ?>" />
                    <a href="#" class="close">x</a>
                    <?php if($i > 0) { ?>
                    	<a href="#imagem<?php echo $i - 1; ?>" class="more"><</a>
                    <?php }
						if($rst['selecionada'] == 0) {
					?>
				            <a class="more" id="mar1<?php echo $rst['id'] ?>" onclick="SubmitForm(<?php echo $rst['id'] ?>)">marcar</a>
				            <a class="more" id="desmar1<?php echo $rst['id'] ?>" style="display:none;" onclick="SubmitForm2(<?php echo $rst['id'] ?>)">desmarcar</a>
				    <?php
						} else {
					?>
				        	<a class="more" id="mar1<?php echo $rst['id'] ?>" style="display:none;" onclick="SubmitForm(<?php echo $rst['id'] ?>)">marcar</a>
				            <a class="more" id="desmar1<?php echo $rst['id'] ?>" onclick="SubmitForm2(<?php echo $rst['id'] ?>)">desmarcar</a>
					<?php
						}
						if($i < $qtde - 1) { 
					?>
                    	<a href="#imagem<?php echo $i + 1; ?>" class="more">></a>
                    <?php } ?>
            	</div>
				<span class="backface"></span>
<?php
	}
	$con->fechar();
?>
			</li>
			</ul>
		</div>
		<div class="container">
		<!--<div class="container" span4 offset4> -->
			<?php if($totalpaginas > 1){ ?>
			<br>
    		Pagina <?php echo $pagina; ?> de <?php echo $totalpaginas; ?>
    		<br><br>
			<?php if($pagina > 1) { ?>
			<a type="button" class="btn" href="album.php?id=<?php echo $id; ?>&nome=<?php echo $album; ?>&pag=<?php echo $pagina - 1?>">Anterior</a>
			<?php } else {?>
			<a type="button" class="btn" enable="false">Anterior</a>
			<?php }
			if($pagina < $totalpaginas) { ?>
			<a type="button" class="btn" href="album.php?id=<?php echo $id; ?>&nome=<?php echo $album; ?>&pag=<?php echo $pagina + 1?>">Próxima</a>
			<?php } else {?>
			<a type="button" class="btn" enable="false">Próxima</a>
			<?php } ?>
			<?php } ?>
		</div>
		<br>
        <div class="container">
            <a href="cliente.php" class="btn btn-default">Voltar</a>
        </div>
    </body>
</html>
