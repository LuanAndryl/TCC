<?php
require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include_once 'topo.php';

$rota = new AplicationRoute();
$alunos = $rota->getParams('Frequencia', 'selectAlunoByTurma');
$materia = $rota->getParams('Frequencia', 'selectMateriaByTurma');
$curso = $rota->getParams('Turma', 'selectCursoTurma', $_GET['codTurma']);
$class = $curso[0]['classificacao'];

if ($class == 'Ensino Técnico')
    $mf = TRUE;
else
    $mf = FALSE;

$retorno = $rota->getParams('Frequencia', 'frequeciaDia', 'true');
if (isset($_REQUEST['btnSalvar'])) {
    $_POST['relatorio'] = $retorno;
    $_POST['curso'] = $curso;
}

?>
<form method="post" >
    <div class="hero-unit">
        <?php if (!empty($curso)) { ?>
            <thead COLSPAN="9" align="center"><h3>Curso: <?php echo $curso[0]['nomeCurso'] ?> l Periodo: <?php echo $curso[0]['periodoCurso'] ?> </h3></thead> 
            <thead COLSPAN="9" align="center"><h3>Turma  <?php echo $curso[0]['moduloTurma'] . " - " . $curso[0]['prefixoTurma'] ?> </h3></thead> 
        <?php } else { ?>
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Ops!</strong> Parece que nao temos materias registradas para esta turma/curso
            </div>
        <?php } ?>
        <?php if (!empty($retorno)) { ?>
            <table class="table table-bordered">
                <tr>
                    <th>Nome</th>
                    <?php foreach ($materia as $r => $valor) { ?>
                        <th><?php echo $valor['nomeMateria'] ?></th>
                    <?php } ?>

                </tr>

                <?php foreach ($alunos as $a => $valor) { ?>
                    <tr class="changeColor">
                        <td><?php echo $valor['nomeAluno'] ?></td>
                        <?php
                        foreach ($materia as $k => $vale) {
                            foreach ($retorno as $r => $ret) {
                                if (($valor['codAluno'] == $ret['codAluno']) and ($vale['codMateria'] == $ret['codMateria'])) {
                                    echo "<td>{$ret['frequencia']}%</td>";
                                }
                            }
                        }
                        ?>
                    </tr>
                <?php } ?>
            </table>
            <a class="btn btn-primary" href="outputPdfFrequencia.php?codTurma=<?php echo$_GET['codTurma'] ?>&falta=<?php echo $mf ?>" target="_blanck" >Imprimir </a>
        <?php } else { ?>
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Estranho! </strong> Não tivemos aulas com esta turma ainda :/
            </div>
        <?php } ?>
        <div class="form-actions">
            <input class="btn btn-primary" type='button' value='Voltar' onclick="window.location = 'preFrequencia.php'"> 
        </div>
    </div>
</form>
<?php include 'footer.html' ?>