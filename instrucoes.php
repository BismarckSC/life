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
            <a href="cliente.php">
                <strong>Inicio</strong>
            </a>
            <span class="right">
                <strong style="font-weight: bold;">Seja Bem-Vindo(a) <?php echo $nome; ?>!</strong> <a href="app/logout.php">sair</a>
            </span>
            <div class="clr"></div>
        </div>

        <div class="container">
            <h1 id="logo">
            <img src="images/life_logo.png"/>
            </h1>
        </div>

        <div id="container">
            <h2 class="title"><span>Sistema de Triagem de Fotos<br>Instruções</span></h2>
            <br><br>
        </div>
        
        <div class="container">
            Bem-vindo ao nosso sistema de triagem de fotos!<br>
            Apresentamos a você uma breve introdução de como utilizar nosso sistema!<br><br>
            Ao entrar em nosso sistema, você será direcionado à seguinte tela:<br><br>
            <img src="images/tut1.png"/><br><br>
            1 - ALTERAR SENHA: clique neste link para alterar sua senha de acesso;<br><br>
            2 - SAIR: clique neste link para encerrar o acesso;<br><br>
            3 - Pastas de fotos: suas fotos estão separadas por pastas. Você deve entrar em<br>cada uma para escolher as fotos desejadas;<br><br>
            4 - Contador de fotos selecionadas: informa quantas fotos você selecionou<br>e o total de fotos disponíveis para escolha naquele momento da triagem;<br><br>
            5 - Botão 'Resetar triagem': clique neste botão se desejar rever as fotos que<br>não foram selecionadas previamente, caso deseje alterar alguma seleção;<br><br>
            6 - Botão 'Efetuar triagem': clique neste botão para descartar as fotos não<br>selecionadas e recomeçar a triagem a partir das fotos escolhidas;<br><br>
            7 - Botão 'Finalizar triagem': clique neste botão quando tiver terminado<br>a escolha de fotos e a quantidade de fotos esteja dentro da quantidade<br>recomendada pelo sistema. Ao clicar neste botão e confirmar a ação, você não terá mais acesso ao sistema;<br><br><br>
            Ao clicar em uma das pastas, uma página semelhante à mostrada abaixo será carregada:<br><br>
            <img src="images/tut2.png"/><br><br>
            8 - Botões 'Marcar/Desmarcar': clique nestes botões para marcar uma foto<br>que deseja que esteja no álbum ou desmarcar, caso mude de ideia. Fotos marcadas ficam com<br>uma faixa verde para indicar que foram escolhidas. Fotos não marcadas ou desmarcadas após<br>terem sido marcadas serão descartadas quando clicar no botão 'Efetuar triagem'<br>na tela principal. Ao clicar na foto, acima da faixa branca/verde, a foto será ampliada,<br>como pode ser visto na imagem abaixo;<br><br><br>
            <img src="images/tut3.png"/><br><br>
            9 - Botões de navegação e marcar/desmarcar: utilize estes botões para navegar<br>pelas fotos e selecionar as desejadas. O botão "Fechar" no canto superior esquerdo volta à visualização anterior.<br><br><br>
            Recomendamos fortemente a alteração de senha logo no primeiro acesso!<br><br><br>
            Tenha uma ótima e divertida escolha de de fotos!<br><br><br>
            Deseja visualizar estas instruções no próximo acesso ao sistema?<br><br>

        </div>

        <div class="container">
            <form action="app/parar_tutorial.php" method="post">
                <input type="hidden" name="cliente" value="<?php echo $id; ?>" />
                <a href="cliente.php" class="btn btn-default">Sim</a>
                <button type="submit" class="btn btn-default">Não</button>
            </form>
        
        </div>
        
    </body>
</html>
