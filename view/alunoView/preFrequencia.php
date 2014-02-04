<?php
require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include_once 'topo.php';


$rota = new AplicationRoute();

$turma = $rota->getParams('Frequencia', 'selectTurmaByAluno',$aln[0]['codAluno']);

?>
<form method="post">
    <div class="hero-unit">
        <div class="row-fluid">
            <div class="span6"
                 <!-- Combo dos cursos -->

                 <p class="text-center">
                <h4>Selecione a Turma</h4>
                <select name="codTurma"> 
                    <?php foreach ($turma as $c => $valor) { ?>
                        <option value="<?php echo $valor['codTurma'] ?>"><?php echo $valor['prefixoTurma'] . " " . $valor['moduloTurma'] ?></option>
                    <?php } ?>
                </select>
                <div class="form-actions">
                    <!--Botoes do Form-->
                    <button name="btnSalvar" type="submit" class="btn btn-primary">Proximo</button>
                </div>
                <?php
                if (isset($_REQUEST['btnSalvar'])) {
                    protegeAcesso::_redirect("Location: frequencia.php?codTurma={$_POST['codTurma']}");
                }
                ?>
            </div>
        </div>
    </div>
</form>

<?php include 'footer.html' ?>
