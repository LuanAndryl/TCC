<?php
require_once '../../lib/AplicationRoute.php';
$rota = new AplicationRoute();
$retorno = $rota->getParams('Admistrador', 'selectAdm', null, "where codAdministrador = {$_GET['codAdm']}");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Instalar &middot; SOGFE</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Le styles -->
        <link href="../../estilo/assets/css/bootstrap.css" rel="stylesheet">
        <style type="text/css">
            body {
                padding-top: 20px;
                padding-bottom: 60px;
            }

            /* Custom container */
            .container {
                margin: 0 auto;
                max-width: 1000px;
            }
            .container > hr {
                margin: 60px 0;
            }

            /* Main marketing message and sign up button */
            .jumbotron {
                margin: 80px 0;
                text-align: center;
            }
            .jumbotron h1 {
                font-size: 100px;
                line-height: 1;
            }
            .jumbotron .lead {
                font-size: 24px;
                line-height: 1.25;
            }
            .jumbotron .btn {
                font-size: 21px;
                padding: 14px 24px;
            }

            /* Supporting marketing content */
            .marketing {
                margin: 60px 0;
            }
            .marketing p + h4 {
                margin-top: 28px;
            }


            /* Customize the navbar links to be fill the entire space of the .navbar */
            .navbar .navbar-inner {
                padding: 0;
            }
            .navbar .nav {
                margin: 0;
                display: table;
                width: 100%;
            }
            .navbar .nav li {
                display: table-cell;
                width: 1%;
                float: none;
            }
            .navbar .nav li a {
                font-weight: bold;
                text-align: center;
                border-left: 1px solid rgba(255,255,255,.75);
                border-right: 1px solid rgba(0,0,0,.1);
            }
            .navbar .nav li:first-child a {
                border-left: 0;
                border-radius: 3px 0 0 3px;
            }
            .navbar .nav li:last-child a {
                border-right: 0;
                border-radius: 0 3px 3px 0;
            }
        </style>
        <link href="../../estilo/assets/css/bootstrap-responsive.css" rel="stylesheet">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="../assets/js/html5shiv.js"></script>
        <![endif]-->

        <!-- Fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../../estilo/assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../../estilo/assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../../estilo/assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="../../estilo/assets/ico/apple-touch-icon-57-precomposed.png">
        <link rel="shortcut icon" href="../../estilo/assets/ico/favicon.png">
    </head>
    <form method="post">
        <body >
            <div class="container">
                <div>
                    <hr>
                    <!-- Jumbotron -->
                    <div class="jumbotron masthead">
                        <h1>Passo 2 </h1>
                        <p class="lead">Errou, edite as informações do Admistrador.</p>
                        <div class="progress progress-striped active">
                            <div class="bar" style="width: 20%;"></div>
                        </div>
                        <div class="hero-unit text-left">     
                            <!-- Formularios Simples -->

                            <h4>Nome </h4>
                            <input class="input-xlarge" name="admNome" type="text" value="<?php echo $retorno[0]['nomeAdmin'] ?>"  placeholder ="ex:root"/>
                            <h4>Login </h4>
                            <input class="input-xlarge" name="admLogin" type="text" value="<?php echo $retorno[0]['loginAdmin'] ?>" placeholder ="ex:root"/>
                            <h4>Senha </h4> 
                            <input class="input-medium" name="admSenha" type="password" value="<?php echo $retorno[0]['senhaAdmin'] ?>"  placeholder ="ex:123" />
                            <div class="form-actions">
                                <button name="btnSalvar" type="submit" class="btn btn-danger">Excluir</button>
                                <input class="btn" type='button' value='Cancelar' onclick="window.location = 'passo2.php'">
                            </div>
                            <?php
                            if (isset($_REQUEST['btnSalvar'])) {
                                $rota->setParams($_GET['classe'], $_GET['metodo']);
                                header('Location: passo2.php.php');
                            }
                            ?>
                        </div>

                        <!-- Example row of columns -->
                    </div>
                </div> <!-- /container -->
    </form>
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../../estilo/assets/js/jquery.js"></script>
    <script src="../../estilo/assets/js/bootstrap-transition.js"></script>
    <script src="../../estilo/assets/js/bootstrap-alert.js"></script>
    <script src="../../estilo/assets/js/bootstrap-modal.js"></script>
    <script src="../../estilo/assets/js/bootstrap-dropdown.js"></script>
    <script src="../../estilo/assets/js/bootstrap-scrollspy.js"></script>
    <script src="../../estilo/assets/js/bootstrap-tab.js"></script>
    <script src="../../estilo/assets/js/bootstrap-tooltip.js"></script>
    <script src="../../estilo/assets/js/bootstrap-popover.js"></script>
    <script src="../../estilo/assets/js/bootstrap-button.js"></script>
    <script src="../../estilo/assets/js/bootstrap-collapse.js"></script>
    <script src="../../estilo/assets/js/bootstrap-carousel.js"></script>
    <script src="../../estilo/assets/js/bootstrap-typeahead.js"></script>

</body>
</html>