<?php
session_start();
header("Content-Type: text/html;  charset=utf-8",true);
require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/AplicationRoute.php";
$rota = new AplicationRoute();
if(!isset($_SESSION['desc']) or $_SESSION['desc'] != 'Aluno'){
    $rota->setParams('Index', 'logout');
}

$aln = $rota->getParams('Aluno', 'selectAluno',null,"loginAluno='{$_SESSION['login']}' and senhaAluno='{$_SESSION['senha']}'")
?>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <title>Etec Jacinto Ferreira de Sa &middot;</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="Vinicius" content="">

        <!-- CSS -->
        <link href="../../estilo/assets/css/bootstrap.css" rel="stylesheet">
        <link href="../../estilo/css/auxiliar.css" rel="stylesheet" type="text/css" />

        <style type="text/css">

            html,
            body {
                height: 100%;
                /* The html and body elements cannot have any padding or margin. */
            }

            /* Wrapper for page content to push down footer */
            #wrap {
                min-height: 100%;
                height: auto !important;
                height: 100%;
                /* Negative indent footer by it's height */
                margin: 0 auto -60px;
            }



            /* Custom page CSS
            -------------------------------------------------- */
            /* Not required for template or sticky footer method. */

            #wrap > .container {
                padding-top: 60px;
            }
            .container .credit {
                margin: 20px 0;
            }

            code {
                font-size: 80%;
            }

        </style>
        <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">

        <!-- Incones -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../../estilo/assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../../estilo/assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../../estilo/assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="../../estilo/assets/ico/apple-touch-icon-57-precomposed.png">
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <!-- Logo do Sistema -->  
    <div class="logo">

        <table>
            <tr>
                <td><img src="../../img/logo-etec2.png"></td>
                <td>
                    <form method="post">
                        <span class="label label-warning"> Bem vindo  <?php echo $_SESSION['desc'] . "(a)" ?></span>
                        <button name="btnEditar" type="submit" class="btn btn-primary"> Perfil de <?php echo $aln[0]['nomeAluno'] ?></button>
                        <input name="btnSair" type="submit" value="Sair" class="btn btn-danger">
                        <img width="128" height="128" src="../../img/user-icons/aluno2.png" />
                    </form>
                </td>
            <tr>
        </table>

    </div>
    <?php
    if (isset($_REQUEST['btnSair'])) {
        $rota->setParams('Index', 'logout');
    }
    if (isset($_REQUEST['btnEditar']))
        protegeAcesso::_redirect('Location: editarAluno.php');
    ?>
    <!-- Wrap corpo total da pagina -->
    <div id="wrap">      
        <!-- Barra de Navegação status:Fixa -->
        <div class="navbar navbar-inverse">
            <div class="navbar-inner">
                <div class="container">
                    <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Nome da Barra -->
                    <a class="brand">SOGFe</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav">
                           <!-- Objeto1 -->
                           <li class="active"><a href="home.php">Home</a></li>                          
                           <li> <a href=preFrequencia.php class="">Frequencia</a></li>
                        </ul>
                        <!-- Fechando barra -->
                    </div>
                </div>
            </div>
        </div>
    </head>     
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
    <script type="text/javascript" src="../../estilo/js/auxiliar.js" ></script>
    <body> 