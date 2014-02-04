<?php
require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include_once 'topo.php';

$rota = new AplicationRoute();

$retorno = $rota->getParams('Turma', 'selectTurma', NULL, "where codTurma={$_GET['codTurma']}");
$curso = $rota->getParams('Curso', 'selectCurso', null, "where codCurso={$retorno[0]['codCurso']}");
if (isset($_REQUEST['btnEx'])) {
    $rota->setParams($_GET['classe'], $_GET['metodo']);
    protegeAcesso::_redirect('Location: relatorioTurma.php');
}
if (isset($_REQUEST['btn'])) {
    protegeAcesso::_redirect('Location: relatorioTurma.php');
}

?>
<form method="post">
    <div class="hero-unit">
        <p class="text-center"> <h4>Nome do Curso</h4> <input disabled class="input-xlarge" name="codCurso" value="<?php echo $curso[0]['nomeCurso'] . " - " . $curso[0]['periodoCurso'] ?>"type="text"placeholder ="ex: Informatica"</p>
        <!-- Fomularios simples -->
        <p class="text-center"> <h4>Modulo Turma</h4> <input disabled class="input-large" name="moduloTurma" value="<?php echo $retorno[0]['moduloTurma'] ?>" type="text" placeholder ="ex: Primeiro ou Modulo"</p>
        <p class="text-center"> <h4>Prefixo Turma</h4> <input disabled class="input-small" name="prefixoTurma" value="<?php echo $retorno[0]['prefixoTurma'] ?>" type="text" placeholder ="ex: A ou 1"</p>
        <div class="form-actions">
            <button type="submit" name="btnEx" value="excluir" class="btn btn-danger">Excluir</button>
            <input class="btn" type='button' value='Cancelar' onclick="window.location = 'relatorioTurma.php'">
        </div>
    </div>
</form>

<?php include 'footer.html' ?>