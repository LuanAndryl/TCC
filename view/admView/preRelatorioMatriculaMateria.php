<?php
require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include_once 'topo.php';

$rota = new AplicationRoute();

$materia = $rota->getParams('Materia', 'selectMateriafromTurma', $_GET['codTurma']);
$curso = $rota->getParams('Turma', 'selectCursoTurma', $_GET['codTurma']);

if (isset($_REQUEST['btnSalvar'])) {
    protegeAcesso::_redirect("Location: relatorioMatricula.php?codTurma={$_GET['codTurma']}&codCurso={$_GET['codCurso']}&codMateria={$_POST['codMateria']}&situacao=1");
}

include 'menuRelatorio.html';
?>
<form method="post">
    <div class="hero-unit">
        <div class="row-fluid">
            <div class="span6">
                <p class="text-center"> <h4>Curso Selecionado</h4> <input disabled class="input-xlarge" value="<?php echo $curso[0]['nomeCurso'] ?>" name="classificacao" type="text"placeholder ="ex: Ensino Regular"> </p>
                <input class="btn-small btn-warning" type='button' value='Alterar Curso' onclick="window.location = 'preRelatorioMatriculaCurso.php'">
                <br />
                <br />
                <p class="text-center"> <h4>Turma Selecionada </h4> <input disabled class="input-xlarge" value="<?php echo $curso[0]['moduloTurma'] . " - " . $curso[0]['prefixoTurma'] ?>" name="classificacao" type="text"placeholder ="ex: Ensino Regular"> </p>
                <input class="btn-small btn-warning" type='button' value='Alterar Turma' onclick="window.location = 'preRelatorioMatriculaTurma.php?codCurso=<?php echo $_GET['codCurso'] ?>'">
            </div>
            <div class="span6">

                <!-- Combo dos cursos -->

                <p class="text-center">
                <h4>Selecione a Materia</h4>
                <select name="codMateria"> 
                    <?php foreach ($materia as $c => $valor) { ?>
                        <option value="<?php echo $valor['codMateria'] ?>"><?php echo $valor['nomeMateria'] ?></option>
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
