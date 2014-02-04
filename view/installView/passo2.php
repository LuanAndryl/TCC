
<?php
require_once '../../lib/AplicationRoute.php';

$rota = new AplicationRoute();
$retorno = $rota->getParams('Admistrador', 'selectAdm');

if (isset($_REQUEST['btnSalvar']))
    $rota->setParams('Admistrador', 'addAdm');
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

    <body >
        <div class="container">
            <div>
                <hr>
                <form method="post" >
                    <!-- Jumbotron -->
                    <div class="jumbotron masthead">
                        <h1>Passo 2 </h1>
                        <p class="lead">Configuração dos Admistradores do sistema</p>
                        <div class="progress progress-striped active">
                            <div class="bar" style="width: 66.6%;"></div>
                        </div>
                        <div class="hero-unit text-left">     
                            <!-- Formularios Simples -->

                            <h4>Nome </h4>
                            <input class="input-xlarge" name="admNome" type="text" placeholder ="ex:José da Silva"/>
                            <h4>Login </h4>
                            <input class="input-xlarge" name="admLogin" type="text" placeholder ="ex:jose12"/>
                            <h4>Senha </h4> 
                            <input class="input-medium" name="admSenha" type="password"  placeholder ="ex:123" />
                            <div class="form-actions">
                                <button name="btnSalvar" type="submit" class="btn btn-success">Cadastrar</button>
                                <?php if (!empty($retorno)) { ?>
                                    <a class="btn btn-primary" href="fim.php">Proximo </a>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="hero-unit text-center">
                            <table class="table">
                                <tr>
                                    <th>Ação</th>
                                    <th>Nome Adminstrador</th>
                                    <th>Login do Adminstrador</th>
                                </tr>
                                <?php if (!empty($retorno)) { ?>
                                    <tr class="changeColor" >
                                        <?php foreach ($retorno as $r => $valor) { ?>
                                        <tr class="changeColor">
                                            <td>
                                                <input class="btn-mini btn-warning" type='button' value='Editar' onclick="window.location = 'editarAdm.php?classe=Admistrador&metodo=editAdm&codAdm=<?php echo $valor['codAdministrador'] ?>'"> 
                                                <input class="btn-mini btn-danger" type='button' value='Excluir' onclick="window.location = 'excluirAdm.php?classe=Admistrador&metodo=delAdm&codAdm=<?php echo $valor['codAdministrador'] ?>'">

                                            </td>
                                            <td><?php echo $valor['nomeAdmin'] ?> </td>
                                            <td> <?php echo $valor['loginAdmin'] ?> </td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            <?php } else { ?>
                                <div class=" alert alert " >
                                    <Strong>Hey !</strong> Cadastre alguns Adminstradores :D
                                </div>
                            <?php } ?>

                        </div>
                </form>
                <hr>

                <!-- Example row of columns -->
            </div>
        </div> <!-- /container -->

        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script type="text/javascript" src="../../estilo/js/auxiliar.js" ></script>
        <script type="text/javascript" src="../../estilo/assets/js/jquery.js" ></script>
        <script type="text/javascript" src="../../estilo/js/jquery-validate.js" ></script>
        <script type="text/javascript" src="../../estilo/js/auxiliar.js" ></script>
        <script type="text/javascript" src="../../estilo/js/maskedinput.js" ></script>
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
