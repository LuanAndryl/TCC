<?php
require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include_once 'topo.php';

$rota = new AplicationRoute();
$retorno = $rota->getParams('Frequencia', 'frequenciaAluno', $aln[0]['codAluno']);
$materia = $rota->getParams('Frequencia', 'selectMateriaByTurma');
$curso = $rota->getParams('Turma', 'selectCursoTurma', $_GET['codTurma']);
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
                        <th><a href="materia.php?codTurma=<?php echo $_GET['codTurma'] ?>&codMateria=<?php echo $valor['codMateria'] ?>"><?php echo $valor['nomeMateria'] ?></a></th>
                    <?php } ?>

                </tr>
                <tr class="changeColor">
                    <td><?php echo $aln[0]['nomeAluno'] ?></td>
                    <?php
                    foreach ($materia as $k => $vale) {
                        foreach ($retorno as $r => $ret) {
                            if (($aln[0]['codAluno'] == $ret['codAluno']) and ($vale['codMateria'] == $ret['codMateria'])) {
                                echo "<td>{$ret['frequencia']}%</td>";
                            }
                        }
                    }
                    ?>
                </tr>
            </table>
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