<?php
session_start();
header("Content-Type: text/html;  charset=utf-8", true);
require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/AplicationRoute.php";
require_once "../../lib/protegeAcesso.php";

protegeAcesso::verificaBD();

$rota = new AplicationRoute();
if (!isset($_SESSION['desc']) or $_SESSION['desc'] != 'Adminstrador') {
    $rota->setParams('Index', 'logout');
}

$adm = $rota->getParams('Admistrador', 'selectAdm', null, "where loginAdmin='{$_SESSION['login']}' and senhaAdmin='{$_SESSION['senha']}'");
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
                <td style="padding-left: 250px; float: right">
                    <form method="post">
                        <span class="label label-important"> Bem vindo  <?php echo $_SESSION['desc'] . "(a)" ?></span>
                        <button name="btnEditar" type="submit" class="btn btn-primary"> Perfil de <?php echo $adm[0]['nomeAdmin'] ?></button>
                        <input name="btnMag" type="submit" value="Magic Insert" class="btn">
                        <input name="btnSair" type="submit" value="Sair" class="btn btn-danger">
                        <img src="../../img/user-icons/adm.png" />
                    </form>
                </td>
            <tr>
        </table>
    </div>
    <?php
    if (isset($_REQUEST['btnSair'])) {
        $rota->setParams('Index', 'logout');
    }
    if (isset($_REQUEST['btnMag'])) {
        $rota->setParams('MagicButton', 'makeTheMagic');
    }
    if (isset($_REQUEST['btnEditar']))
        protegeAcesso::_redirect('Location: editarAdm.php');
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
                            <!--Objeto2 -->
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Cadastro<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="cadastroCurso.php">Curso</a></li>
                                    <li><a href="preCadastroTurma.php">Turma</a></li>
                                    <li><a href="cadastroMateria.php">Matérias</a></li>
                                    <li class="divider"></li>
                                    <li><a href="cadastroFuncionario.php">Funcionario</a></li>
                                    <li><a href="cadastroProfessor.php">Professor</a></li>
                                    <li><a href="cadastroAluno.php">Aluno</a></li>
                                </ul>
                            </li>
                            <!-- Objeto 3 -->
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Efetuar<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="preCadastroMateriaTurma.php">Atribuição de Materias</a></li>
                                    <li><a href="preCadastroMatriculaCurso.php">Matricula</a></li>
                                </ul>
                            </li>
                            <!-- Objeto 4 -->
                            <li><a href="relatorioAlunoAtivo.php">Relatório</a></li>
                            <!-- Objeto 5 -->
                            <li><a href="preCodigoBarrasCurso.php">Codigo de Barras</a></li>
                            <li><a href="relatorioAuditoria.php">Auditoria do Sistema</a></li>
                            <?php //<li><a href="novasTurmas.php">Novas Turmas</a></li> ?>
                        </ul>
                        <!-- Fechando barra -->
                    </div>
                </div>
            </div>
        </div>
    </head>     
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
    <body> 