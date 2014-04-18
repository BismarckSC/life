<?php
    session_start();
    include 'app/conexao.php';
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
            <a href="admin.html">
                <strong>Inicio</strong>
            </a>
            <span class="right">
            	<strong style="font-weight: bold;">Seja Bem-Vindo ADMINISTRADOR!</strong> <a href="app/logout.php">sair</a>
            </span>
            <div class="clr"></div>
        </div>
        
        <div class="container">
            <h1 id="logo">
            <img src="images/life_logo.png"/>
            </h1>
        </div>

        <div id="container">
            <h2 class="title"><span>Sistema de Triagem de Fotos<br>Triagens em andamento</span></h2>
			<ul id="grid" class="group">
                <?php
                    $con = new Conexao;
    
                    $con->criar();
                    $con->selecionar();
                    $con->executar("SELECT id, nome, evento, capa FROM cliente WHERE acesso = 1 ORDER BY nome;");
                    $qtde = $con->qtde();
                    for($i = 0; $i < $qtde; $i++) {
                        $rst = $con->proxima();
                        
                        if($rst["capa"] == 'none') {
                        	$cliente = $rst["id"];
                        	$con1 = new Conexao;
							$con1->criar();
							$con1->selecionar();
							$con1->executar("SELECT p.nome pasta, f.nome foto FROM cliente_pasta cp, pasta p, pasta_fotos pf, fotos f WHERE cp.id_cliente = $cliente and cp.id_pasta = p.id and p.id = pf.id_pasta and pf.id_foto = f.id limit 1;");							
							$rst1 = $con1->proxima();
							$capa = "uploads/" . $cliente . "/" . $rst1["pasta"] . "/" . $rst1["foto"];
                        } else {
                        	$cliente = $rst["id"];
                        	$capa = "uploads/" . $cliente . "/" . $rst["capa"];
                        }
                ?>
                <li>
                    <div class="details2">
                        <h3><?php echo $rst["nome"]; ?></h3>
                    </div>
                   <a class="more" href="editar_album.php?id=<?php echo $rst['id']; ?>&nome=<?php echo $rst['nome']; ?>"><img src="<?php echo $capa; ?>" width="290px"/></a>
                </li>
                <?php
                    }
                    $con->fechar();
                ?>
		 	</ul>
        </div>
        <div class="container">
        	 <!-- <a href="app/enviar_not.php" class="btn btn-default">Enviar Notificações</a> -->
            <a href="admin.html" class="btn btn-default">Voltar</a>
        </div>
    </body>
</html>
