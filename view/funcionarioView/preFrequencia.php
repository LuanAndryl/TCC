<?php
require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include_once 'topo.php';

$rota = new AplicationRoute();
$retorno = $rota->getParams('Turma', 'selectTurma', null, "where codCurso={$_GET['codCurso']}");
if (isset($_REQUEST['btOk'])) {
    protegeAcesso::_redirect("Location: frequencia.php?codTurma={$_POST['codTurma']}");
}

?>
<div class="hero-unit">
    <form method="post">
        <h4>Selecione uma Turma</h4>
        <select name="codTurma">
            <?php foreach ($retorno as $t => $valor) { ?>
                <option value="<?php echo $valor['codTurma'] ?>" ><?php echo $valor['moduloTurma'] . " " . $valor['prefixoTurma'] ?></option>
            <?php } ?>
        </select>
        <br>
        <input type="submit" class="btn btn-primary" name="btOk" value="Confirmar">
        <button type="submit" class="btn">Voltar</button>

    </form>
</div>
<?php include 'footer.html' ?>