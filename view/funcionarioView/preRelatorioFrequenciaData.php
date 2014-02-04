<?php
require_once '../../lib/AplicationRoute.php';

$rota = new AplicationRoute();
$data = $rota->getParams('Frequencia', 'selectChamada');
if (isset($_REQUEST['btnSalvar'])) {
    
}
if (isset($_REQUEST['btnLimpar']))
    header('Location: relatorioCurso.php');
var_dump($data);
include 'topo.php';
?>
<form method="post">
    <div class="hero-unit">
        <h4>Classificação do Curso</h4>

        <select name="data">
            <?php foreach ($data as $d => $valor) { ?>
                <option value="1"><?php echo $valor['dataChamada'] ?></option>
            <?php } ?>
        </select>
        <div class="form-actions">
            <button name="btnSalvar" type="submit" class="btn btn-primary">Próximo</button>
            <input name="btnLimpar" type="submit" value="Cancelar" class="btn">
        </div>
    </div>
</form>
<?php include 'footer.html' ?>         