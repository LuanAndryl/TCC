<?php
require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include_once 'topo.php';

$rota = new AplicationRoute();
if (isset($_REQUEST['btnSalvar'])) {
    if ($_POST['tipo'] == 1) {
        protegeAcesso::_redirect('Location: cadastroTurmaEM.php');
    } else if ($_POST['tipo'] == 2) {
        protegeAcesso::_redirect('Location: cadastroTurmaET.php');
    } else if ($_POST['tipo'] == 3) {
        protegeAcesso::_redirect('Location: cadastroTurmaETIM.php');
    }
}
if (isset($_REQUEST['btnLimpar']))
    protegeAcesso::_redirect('Location: relatorioCurso.php');


?>
<form method="post">
    <div class="hero-unit">
        <h4>Classificação do Curso</h4>
        <select name="tipo">
            <option value="1">Ensino Regular</option>
            <option value="2">Ensino Técnico</option>
            <option value="3">Ensino Técnico Integrado ao Médio</option>
        </select>
        <div class="form-actions">
            <button name="btnSalvar" type="submit" class="btn btn-primary">Próximo</button>
            <input name="btnLimpar" type="submit" value="Cancelar" class="btn">
        </div>
    </div>
</form>
<?php include 'footer.html' ?>         