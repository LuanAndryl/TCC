<?php

require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include_once 'topo.php';

$rota = new AplicationRoute();

$turma = $rota->getParams('Turma', 'selectTurma', null, "where codCurso={$_GET['codCurso']}");
if (isset($_REQUEST['btnSalvar'])) {
    protegeAcesso::_redirect("Location: geraCodigoDeBarra.php?codTurma={$_POST['codTurma']}");
}

?>
<form method="post">
    <div class="hero-unit">
        <div class="row-fluid">
            <div class="span6">

                <!-- Combo dos cursos -->

                <p class="text-center">
                <h4>Selecione a Turma</h4>
                <select name="codTurma"> 
                    <?php foreach ($turma as $c => $valor) { ?>
                        <option value="<?php echo $valor['codTurma'] ?>"><?php echo $valor['moduloTurma'] . " - " . $valor['prefixoTurma'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-actions">
                <!--Botoes do Form-->
                <button name="btnSalvar" type="submit" class="btn btn-primary">Ok</button>
                <input name="btnLimpar" type="submit" value="Cancelar" class="btn">
            </div>
        </div>
    </div>  
</form>
<?php include 'footer.html' ?>
