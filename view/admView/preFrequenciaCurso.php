<?php

require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include_once 'topo.php';

$rota = new AplicationRoute();

$curso = $rota->getParams('Curso', 'selectCurso');
if (isset($_REQUEST['btnSalvar'])) {
    protegeAcesso::_redirect("Location: preFrequencia.php?codCurso={$_POST['curso']}");
}

?>
<form method="post">
    <div class="hero-unit">
        <div class="row-fluid">
            <div class="span6">

                <!-- Combo dos cursos -->

                <p class="text-center">
                <h4>Selecione o Curso</h4>
                <select name="curso"> 
                    <?php foreach ($curso as $c => $valor) { ?>
                        <option value="<?php echo $valor['codCurso'] ?>"><?php echo $valor['nomeCurso'] . " - " . $valor['periodoCurso'] ?></option>
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
