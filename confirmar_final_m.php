<?php
	include 'app/conexao.php';
    session_start();
    $nome = $_SESSION["user_nome"];
    $id = $_SESSION["user_id"];
    
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
        <title>Life - Triagem de fotos (Administrador)</title>
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
            Seja Bem-Vindo(a) <strong><?php echo $nome; ?></strong>!|<a href="app/logout.php">sair</a>
        </div>
        
        <div class="container" align="center">
            <h1 id="logo">
            <a href="cliente.php">
            <img src="images/life_logo.png"/>
        	</a>
            </h1>
        </div>
        
        <?php
        if($fotos_selecionadas > 170) {
        ?>
         <div class="container" align="center">
            <h2 class="title"><span>Sistema de Triagem de Fotos<br>
            Você selecionou <?php echo $fotos_selecionadas; ?> fotos, está além do limite permitido.<br>
            Por favor selecione no máximo até 170 fotos.<br>
            É aconselhável que o número de fotos escolhidas<br>
            fique entre 80 e 120 fotos.</span></h2>
            <br><br>
        </div>
        <div class="container" align="center">
            <a href="cliente.php" class="btn btn-large">Voltar</a>
        </div>
        <?php
        } else if($fotos_selecionadas <= 120 and $fotos_selecionadas >= 80) {
        ?>
        <div class="container" align="center">
            <h2 class="title"><span>Sistema de Triagem de Fotos<br>
            Você selecionou <?php echo $fotos_selecionadas; ?> fotos.</span></h2>
            <br><br>
        </div>
        <div class="container" align="center">
        	<a href="finalizar_triagem_m.php?id=<?php echo $id; ?>&nome=<?php echo $nome; ?>" class="btn btn-large">Continuar</a>
            <a href="cliente.php" class="btn btn-large">Voltar</a>
        </div>
        <?php
        } else {
        ?>
        <div class="container" align="center">
            <h2 class="title"><span>Sistema de Triagem de Fotos<br>
            Você selecionou <?php echo $fotos_selecionadas; ?> fotos.<br>
            É aconselhável que o número de fotos escolhidas<br>
            fique entre 80 e 120 fotos.</span></h2>
            <br><br>
        </div>
        <div class="container" align="center">
        	<a href="finalizar_triagem_m.php?id=<?php echo $id; ?>&nome=<?php echo $nome; ?>" class="btn btn-large">Continuar</a>
            <a href="cliente.php" class="btn btn-large">Voltar</a>
        </div>
        <?php
        }
        ?>
        
    </body>
</html>
