<?php
require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include_once 'topo.php';
include 'menuRelatorio.html';

$rota = new AplicationRoute();

$mtr = $rota->getParams('Matricula', 'selectEditSituacao', $_GET['situacao']);
if (isset($_REQUEST['btnAt']))
    $rota->setParams('Matricula', 'editMatricula');
if (isset($_REQUEST['btnLimpar'])) {
    protegeAcesso::_redirect("Location: relatorioMatricula.php?codTurma={$_GET['codTurma']}&codCurso={$_GET['codCurso']}&codMateria={$_GET['codMateria']}&situacao={$_GET['situacao']}");
    exit();
}

?>
<form method="post">
    <div class="hero-unit">
        <div class="row-fluid">
            <table class="table">
                <tr>
                    <th>Situação</th>
                    <th>Nome Aluno</th>
                    <th>Nome Materia</th>
                    <th>Curso - Periodo </th>
                    <th>Turma</th>

                </tr>
                <?php foreach ($mtr as $m => $valor) { ?>
                    <tr class='changeColor'>
                        <td>  
                            <select name="situacao">
                                <option value="1"> Matriculado </option>
                                <option value="2"> AE - Aproveitamento de Estudo </option>
                                <option value="3"> Trancamento </option>
                                <option value="4"> Desistente </option>
                            </select>
                        </td>
                        <td> <?php echo $valor['nomeAluno']; ?> </td>
                        <td> <?php echo $valor['nomeMateria']; ?> </td>
                        <td> <?php echo $valor['nomeCurso'] . " " . $valor['periodoCurso']; ?> </td>
                        <td> <?php echo $valor['moduloTurma'] . " " . $valor['prefixoTurma']; ?> </td>
                    <input type="hidden" name='codMatMtr' value="<?php echo $valor['codMateriaMatricula']; ?>">
                    </tr>
                <?php } ?>
            </table>
        </div>
        <div class="form-actions">
            <button type="submit" name="btnAt" value="Atualizar" class="btn btn-warning">Atualizar</button>
            <input name="btnLimpar" type="submit" value="Cancelar" class="btn">
        </div>
    </div>  
</form>


<?php include 'footer.html' ?>