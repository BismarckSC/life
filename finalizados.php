<?php
    session_start();
    include 'app/conexao.php';

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
        <title>Life - Triagem de fotos (Administrador)</title>
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
            	Seja Bem Vindo <strong>ADMINISTRADOR</strong>! <a href="">alterar senha</a> | <a href="">sair</a>
            </span>
            <div class="clr"></div>
        </div>
        
        <div class="container">
            <h1 id="logo">
            <img src="images/life_logo.png"/>
            </h1>
        </div>

        <div id="container">
            <h2 class="title"><span>Sistema de Triagem de Fotos<br>Triagens finalizadas</span></h2>
			<ul id="grid" class="group">
		        <?php
                    $con = new Conexao;
    
                    $con->criar();
                    $con->selecionar();
                    $con->executar("SELECT id, nome, evento FROM cliente WHERE acesso = 0;");
                    $qtde = $con->qtde();
                    for($i = 0; $i < $qtde; $i++) {
                        $rst = $con->proxima();
                ?>
                <li>
                    <div class="details1">
                        <h3><?php echo $rst["nome"]; ?></h3>
                    </div>
                   <a class="more" href="album.php?id=<?php echo $rst['id']; ?>&nome=<?php echo $rst['nome']; ?>"><img src="images/pasta.png" width="290px"/></a>
                </li>
                <?php
                    }
                    $con->fechar();
                ?>
		 	</ul>
        </div>
    </body>
</html>
