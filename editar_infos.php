<?php
    include 'app/conexao.php';

    session_start();
    //$id = $_SESSION["e_album_id"];
    $id = $_GET["id"];
    $nome = $_GET["nome"];
    $_SESSION["e_album_id"] = $id;
    $_SESSION["e_album_nome_cliente"] = $nome;
    
    $con = new Conexao;
    
    $con->criar();
    $con->selecionar();
    $con->executar("SELECT nome, evento, descricao FROM cliente WHERE id = '$id';");
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
        <title>Life - Triagem de fotos (Administrador)</title>
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
            <a href="admin.html">
                <strong>Inicio</strong>
            </a>
            <span class="right">
            	Seja Bem Vindo <strong>ADMINISTRADOR</strong>! <a href="">(sair)</a>
            </span>
            <div class="clr"></div>
        </div>
        
        <div class="container">
        	<h1 id="logo">
            <img src="images/life_logo.png"/>
            </h1>
        </div>

        <div id="container">
        	<h2 class="title"><span>Sistema de Triagem de Fotos<br>Editar informações do álbum</span></h2>
        
    	</div>
        
        </br></br>
        
        <div id="container">
			<form role="form" method="post" action="app/editar_infos.php">
				<div class="form-group">
                    <?php
                        $rst = $con->proxima();
                        $con->fechar();
                    ?>
					<label>Nome</label>
					<input type="text" class="form-control" name="txtnome" value="<?php echo $rst["nome"]; ?>" placeholder="Insira o nome do cliente">
					<label>Evento</label>
					<input type="text" class="form-control" name="txtevento" value="<?php echo $rst["evento"]; ?>" placeholder="Insira o título do evento">
					<label>Descrição</label>
					<textarea rows="5" type="text" class="form-control" name="txtdesc" placeholder="Insira uma breve descrição"><?php echo $rst["descricao"]; ?></textarea>
				</div>
                <br>
                <input type="hidden" name="idcli" value='<?php echo $id; ?>' />
				<button type="submit" class="btn btn-default">Salvar</button>
                <a href="editar_album.php?id=<?php echo $id; ?>&nome=<?php echo $nome; ?>" class="btn btn-default">Cancelar</a>
			</form>			
        </div>
    </body>
</html>
