<?php
include 'topo.php';
require_once '../../lib/AplicationRoute.php';

$rota = new AplicationRoute();
$retorno = $rota->getParams('Frequencia', 'frequenciaMateria', $aln[0]['codAluno']);
$informacoes = $rota->getParams('MateriaTurma', 'selectProfByMatAndTurma');
$curso = $rota->getParams('Curso', 'selectCursoTurma');

$today = null;
?>
<div class="hero-unit">

    <table class="table table-bordered">
        <thead align="center">
        <h4>Curso: <?php echo $curso[0]['nomeCurso'] ?> - Periodo: <?php echo $curso[0]['periodoCurso'] ?> <br>
            Materia: <?php echo $informacoes[0]['nomeMateria'] ?> <br>
            Professor: <?php echo $informacoes[0]['nomeProf'] ?> <br>
            Aluno: <?php echo $aln[0]['nomeAluno'] ?></h4>
        </thead> 
        <tr>
            <th> Data </th>
            <?php foreach ($retorno as $r => $valor) { ?>
                <?php
                $today = $valor['dataChamada'];
                $today = implode("/", array_reverse(explode("-", $today)));
                ?>
                <td><?php echo $today ?></td>
            <?php } ?>
        </tr>
        <tr class ="changeColor">
            <th>Chamada </th>
            <?php foreach ($retorno as $r => $valor) { ?>
                <?php
                if ($valor['falta'] == '1')
                    echo "<td><i class='icon-ok'></i></td>";
                if ($valor['falta'] == '2')
                    echo "<td><i class='icon-exclamation-sign'></i></td>";
                if ($valor['falta'] == '3')
                    echo "<td><i class='icon-remove'></i></td>";
                ?>
            <?php } ?>
        </tr>
    </table>
    <div class="form-actions">
        <input class="btn btn-primary" type='button' value='Voltar' onclick="window.location = 'frequencia.php?codTurma=<?php echo $_GET['codTurma'] ?>'"> 
    </div>
</div>
<?php include 'footer.html' ?>