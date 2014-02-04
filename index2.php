<?php
require_once 'lib/AplicationRoute.php';
$rota = new AplicationRoute();
?>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <title> Etec Jacinto Ferreira de Sa &middot;</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="Vinicius" content="">

        <!-- Estilos -->
        <link href="estilo/assets/css/bootstrap.css" rel="stylesheet">
        <style type="text/css">
            body {
                padding-top: 40px;
                padding-bottom: 40px;
                background-color: #f5f5f5;
            }

            .form-signin {
                max-width: 300px;
                padding: 19px 29px 29px;
                margin: 0 auto 20px;
                background-color: #fff;
                border: 1px solid #e5e5e5;
                -webkit-border-radius: 5px;
                -moz-border-radius: 5px;
                border-radius: 5px;
                -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
            }
            .form-signin .form-signin-heading,
            .form-signin .checkbox {
                margin-bottom: 10px;
            }
            .form-signin input[type="text"],
            .form-signin input[type="password"] {
                font-size: 16px;
                height: auto;
                margin-bottom: 15px;
                padding: 7px 9px;
            }

        </style>
        <link href="estilo/assets/css/bootstrap-responsive.css" rel="stylesheet">

        <!--Icones -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="estilo/assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="estilo/assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="estilo/assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="estilo/assets/ico/apple-touch-icon-57-precomposed.png">
        <link rel="shortcut icon" href="estilo/assets/ico/favicon.png">
    </head>

    <body>
    <center>
        <img src="img/logo-etec-sem-fundo.png">
    </center>
    <br />
    <br />
    <div class="container">
        <!-- Form de Login -->
        <form method="post" class="form-signin">
            <h2 class="form-signin-heading">Efetue seu login</h2>
            <input type="text" name="login" class="input-block-level" placeholder="Login">
            <input type="password" name="senha" class="input-block-level" placeholder="Senha">
            <input type="hidden" name="logando" value="ok">
            <button class="btn btn-large btn-primary" name="btnOk" type="submit">Logar </button>
            <?php
            if (isset($_REQUEST['btnOk'])) {
                $rota->setParams('Index', 'login');
            }
            ?>

        </form>
        <div class="alert alert-error">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Ops! Algo errado :( </strong> Login ou senha incorretos.
        </div>
    </div>

    <!-- Placed at the end of the document so the pages load faster -->
    <script src="estilo/assets/js/jquery.js"></script>
    <script src="estilo/assets/js/bootstrap-transition.js"></script>
    <script src="estilo/assets/js/bootstrap-alert.js"></script>
    <script src="estilo/assets/js/bootstrap-modal.js"></script>
    <script src="estilo/assets/js/bootstrap-dropdown.js"></script>
    <script src="estilo/assets/js/bootstrap-scrollspy.js"></script>
    <script src="estilo/assets/js/bootstrap-tab.js"></script>
    <script src="estilo/assets/js/bootstrap-tooltip.js"></script>
    <script src="estilo/assets/js/bootstrap-popover.js"></script>
    <script src="estilo/assets/js/bootstrap-button.js"></script>
    <script src="estilo/assets/js/bootstrap-collapse.js"></script>
    <script src="estilo/assets/js/bootstrap-carousel.js"></script>
    <script src="estilo/assets/js/bootstrap-typeahead.js"></script>

</body>
</html>
