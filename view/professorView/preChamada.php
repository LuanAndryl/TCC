<?php
require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include 'topo.php';

$rota = new AplicationRoute();
$turma = $rota->getParams('Chamada', 'selectTurmaByProf');
$materia = $rota->getParams('Chamada', 'selectMateriaClass', $_GET['codMateria']);

if (isset($_REQUEST['btnSalvar'])) {
    if ($materia[0]['classificacao'] == 'Ensino Regular') {
        $rota->setParams('Chamada', 'addChamada');
        protegeAcesso::_redirect("Location: chamada1.php?codMateria={$_GET['codMateria']}&codProf={$_GET['codProf']}&codTurma={$_POST['codTurma']}");
        exit();
    }
    if ($materia[0]['classificacao'] == 'Ensino Técnico') {
        $rota->setParams('Chamada', 'addChamada');
        protegeAcesso::_redirect("Location: chamada2.php?codMateria={$_GET['codMateria']}&codProf={$_GET['codProf']}&codTurma={$_POST['codTurma']}");
        exit();
    }
}
if (isset($_REQUEST['btnLimpar']))
    protegeAcesso::_redirect('Location: relatorioTurma.php');

?>
<form method="post">
    <div class="hero-unit">
        <div class="row-fluid">
            <div class="span6">
                <p class="text-center"> <h4>Materia</h4> <input disabled class="input-xlarge" value="<?php echo $materia[0]['nomeMateria'] ?>" name="materia" type="text"placeholder ="ex: Ensino Regular"> </p>
                <input class="btn-small btn-warning" type='button' value='Alterar Materia' onclick="window.location = 'preChamadaMateria.php?codProf=<?php echo $_GET['codProf'] ?>'"> 
            </div>
            <div class="span6">
                <p class="text-center"> <h4>Turma</h4>
                <select name="codTurma">
                    <?php foreach ($turma as $t => $value) { ?>
                        <option value="<?php echo $value['codTurma'] ?>"><?php echo $value['moduloTurma'] . " - " . $value['prefixoTurma'] ?></option>
                    <?php } ?>
                </select>
                <div class="form-actions">
                    <!--Botoes do Form-->
                    <button name="btnSalvar" type="submit" class="btn btn-info">Iniciar Chamada</button>
                    <input name="btnLimpar" type="submit" value="Cancelar" class="btn">
                </div>
            </div>
        </div>
    </div>
</form>


<?php include 'footer.html' ?>