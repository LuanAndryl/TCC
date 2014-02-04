<?php
require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include_once 'topo.php';

$rota = new AplicationRoute();

$turma = $rota->getParams('Turma', 'selectTurma', null, "where codCurso={$_GET['codCurso']}");
$curso = $rota->getParams('Curso', 'selectCurso');

if (isset($_REQUEST['btnSalvar'])) {
    protegeAcesso::_redirect("Location: relatorioMateriaTurma.php?codTurma={$_POST['codTurma']}&codCurso={$_GET['codCurso']}");
}

include 'menuRelatorio.html';
?>
<form method="post">
    <div class="hero-unit">
        <div class="row-fluid">
            <div class="span6">

                <!-- Combo dos cursos -->
                <p class="text-center"> <h4>Curso Selecionado</h4> <input disabled class="input-large" name="nomeCurso" value="<?php echo $curso[0]['nomeCurso']; ?>" type="text"placeholder ="ex: Ensino Médio"</p>
                <br/>
                <!--Botoes do Form-->
                <br>
                <input class="btn-warning btn-small" type="button" value="Escolher Outro Curso"  onclick="window.location = 'preRelatorioMateriaTurmaCurso.php'">
            </div>
            <div class="span6">
                <p class="text-center">
                <h4>Selecione a Turma</h4>
                <select name="codTurma"> 
                    <?php foreach ($turma as $c => $valor) { ?>
                        <option value="<?php echo $valor['codTurma'] ?>"><?php echo $valor['moduloTurma'] . " - " . $valor['prefixoTurma'] ?></option>
                    <?php } ?>
                </select>
                <div class="form-actions">
                    <!--Botoes do Form-->
                    <button name="btnSalvar" type="submit" class="btn btn-primary">Proximo</button>
                </div>
            </div>
        </div>
    </div>  
</form>
<?php include 'footer.html' ?>
