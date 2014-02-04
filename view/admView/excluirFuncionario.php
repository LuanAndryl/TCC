<?php

require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include_once 'topo.php';

$rota = new AplicationRoute();

$retorno = $rota->getParams('Funcionario', 'selectFunc', NULL, "where codFunc={$_GET['codFunc']}");
if (isset($_REQUEST['btnEx'])) {
    $rota->setParams($_GET['classe'], $_GET['metodo']);
    protegeAcesso::_redirect('Location: relatorioFuncionario.php');
}
if (isset($_REQUEST['btnLimpar']))
    protegeAcesso::_redirect('Location: relatorioFuncionario.php');


?>
<div class="hero-unit">
    <form method="post">

        <!-- Formularios Dados do Curso -->

        <p class="text-center"> <h4>Nome do Funcionario</h4> <input disabled class="input-xlarge" name="nomeCurso" value="<?php echo $retorno[0]['nomeFunc'] ?>" type="text"placeholder ="ex: Informatica"</p>
        <p class="text-center"> <h4>Login do Funcionario</h4> <input disabled class="input-medium" name="periodoCurso" value="<?php echo $retorno[0]['loginFunc'] ?>" type="text"placeholder ="ex: Vespertino"</p>

        <!-- Botões do Form -->

        <div class="form-actions">
            <button type="submit" name="btnEx" value="excluir" class="btn btn-danger">Excluir</button>
            <input class="btn" type='button' value='Cancelar' onclick="window.location = 'relatorioFuncionario.php'">
        </div>

    </form>
</div>
<?php include 'footer.html' ?>