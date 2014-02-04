<?php

require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include_once 'topo.php';

$rota = new AplicationRoute();

$retorno = $rota->getParams('Curso', 'selectCurso', NULL, "where codCurso={$_GET['codCurso']}");
if (isset($_REQUEST['btnEx'])) {
    $rota->setParams($_GET['classe'], $_GET['metodo']);
    protegeAcesso::_redirect('Location: relatorioCurso.php');
}

?>
<form method="post">
    <div class="hero-unit">

        <!-- Formularios Dados do Curso -->
        <p class="text-center"> <h4>Classificação Curso</h4> <input class="input-medium" name="classificacao" value="<?php echo $retorno[0]['classificacao'] ?>" type="text"placeholder ="ex: Ensino Regular" disabled="disabled"</p>
        <p class="text-center"> <h4>Nome do Curso</h4> <input class="input-xlarge" name="nomeCurso" value="<?php echo $retorno[0]['nomeCurso'] ?>" type="text"placeholder ="ex: Informatica" disabled="disabled"</p>
        <p class="text-center"> <h4>Periodo Curso</h4> <input class="input-medium" name="periodoCurso" value="<?php echo $retorno[0]['periodoCurso'] ?>" type="text"placeholder ="ex: Vespertino" disabled="disabled"</p>

        <!-- Botões do Form -->

        <div class="form-actions">
            <button type="submit" name="btnEx" value="excluir" class="btn btn-danger">Excluir</button>
            <input class="btn" type='button' value='Cancelar' onclick="window.location = 'relatorioCurso.php'">
        </div>
    </div>
</form>
<?php include 'footer.html' ?>