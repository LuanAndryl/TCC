<?php
require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include_once 'topo.php';

$rota = new AplicationRoute();

$turma = $rota->getParams('Turma', 'selectTurma', null, "where codCurso={$_GET['codCurso']}");
$curso = $rota->getParams('Curso', 'selectCurso');

if (isset($_REQUEST['btnSalvar'])) {
    protegeAcesso::_redirect("Location: preRelatorioMatriculaMateria.php?codTurma={$_POST['codTurma']}&codCurso={$_GET['codCurso']}&situacao=1");
}

include 'menuRelatorio.html';
?>
<form method="post">
    <div class="hero-unit">
        <div class="row-fluid">
            <div class="span6">
                <p class="text-center"> <h4>Curso Selecionado</h4> <input disabled class="input-xlarge" value="<?php echo $curso[0]['nomeCurso'] ?>" name="classificacao" type="text"placeholder ="ex: Ensino Regular"> </p>
                <input class="btn-small btn-warning" type='button' value='Alterar Curso' onclick="window.location = 'preRelatorioMatriculaCurso.php'"> 
            </div>
            <div class="span6">

                <!-- Combo dos cursos -->

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
