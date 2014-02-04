<?php
require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include 'topo.php';

$rota = new AplicationRoute();
$retorno = $rota->getParams("Chamada", "selectAllDatasChamadasProf", $prof[0]['codProf']);
if (isset($_REQUEST['btnSalvar'])) {
    protegeAcesso::_redirect("Location: aulasDadas.php?data={$_POST['data']}");
}
if (isset($_REQUEST['btnLimpar']))
    protegeAcesso::_redirect('Location: home.php');

?>
<form method="post" >
    <div class="hero-unit">
        <h4>Escolha a Data Que Deseje Consultar</h4>

        <select name="data">
            <?php foreach ($retorno as $key => $valor) { ?>
                <?php
                $today = $valor['dataChamada'];
                $today = implode("/", array_reverse(explode("-", $today)));
                ?>
                <option value="<?php echo $valor['dataChamada'] ?>"><?php echo $today ?></option>
            <?php } ?>
        </select>
        <div class="form-actions">
            <!--Botoes do Form-->
            <button name="btnSalvar" type="submit" class="btn btn-primary">Salvar</button>
            <input name="btnLimpar" type="submit" value="Cancelar" class="btn">
        </div>
    </div>
</form>
<?php include 'footer.html' ?>