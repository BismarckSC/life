<?php
	session_start();

	$nome = $_SESSION["user_nome"];
	$id = $_SESSION["user_id"];
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
		<script type="text/javascript" src="js/modernizr.custom.86080.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
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
    	<div class="well">
            <strong style="font-weight: bold;">Seja Bem-Vindo(a) <?php echo $nome; ?>!</strong>|<a href="app/logout.php">sair</a>
        </div>
        
        <div class="container" align="center">
            <h1 id="logo">
            <a href="cliente.php">
            <img src="images/life_logo.png"/>
        	</a>
            </h1>
        </div>

        <div class="container" align="center">
            <h2 class="title"><span>Sistema de Triagem de Fotos<br>Após esta ação você não poderá mais acessar o sistema!<br>Finalizar triagem?</span></h2>
            <br><br>
        </div>
		
        <div class="container" align="center">
            <form action="app/bloquear_acesso.php" method="post">
                <input type="hidden" name="acesso" value="<?php echo $id; ?>" />
                <input type="hidden" name="solicitante" value="0" />
                <input type="hidden" name="nome" value="<?php echo $nome; ?>">
                <button type="submit" class="btn btn-large">Sim</button>
                <a href="cliente.php" class="btn btn-large">Não</a>
            </form>
        
        </div>
        
    </body>
</html>
