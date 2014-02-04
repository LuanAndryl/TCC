<?php
include 'topo.php';

require_once '../../lib/AplicationRoute.php';

$rota = new AplicationRoute();
$retorno = $rota->getParams("Chamada", "selectAulasProfessor", $prof[0]['codProf']);
$todayI = $retorno[0]['dataChamada'];
$todayI = implode("/", array_reverse(explode("-", $todayI)));
?>

<div class="hero-unit">
    <h4>Aulas Dadas Referente a Data:<?php echo $todayI ?></h4>
    <br>
    <table class="table table-bordered">
        <tr class='changeColor'>
            <th>Data</th>
            <th>Turma</th>
        </tr>
        <?php foreach ($retorno as $r => $valor) { ?>
            <tr class='changeColor'>
                <?php
                $today = $valor['dataChamada'];
                $today = implode("/", array_reverse(explode("-", $today)));
                ?>
                <td><?php echo $today ?></td>
                <td><?php echo $valor['nomeCurso'] . " - " . $valor['periodoCurso'] . "  ||  " . $valor['moduloTurma'] . "-" . $valor['prefixoTurma'] ?></td>
            </tr>
        <?php } ?>
    </table>
</div>
<?php include 'footer.html' ?>