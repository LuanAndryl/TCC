<?php

require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include_once 'topo.php';

$rota = new AplicationRoute();
if (isset($_REQUEST['btnEm'])) {
    $rota->setParams('NovasTurmas', 'novasTurmasEM');
}
if (isset($_REQUEST['btnEt'])) {
    $rota->setParams('NovasTurmas', 'novasTurmasET');
}
if (isset($_REQUEST['btnEtim'])) {
    $rota->setParams('NovasTurmas', 'novasTurmasETIM');
}

?>
<form method="post">
    <div class="hero-unit">
        <div class="row-fluid">
            <div class="span6">
                <div class="form-actions">
                    <!--Botoes do Form-->
                    <button name="btnEm" type="submit" class="btn btn-warning">Novas Turmas Ensino Medio</button>
                </div>
                <div class="form-actions">
                    <!--Botoes do Form-->
                    <button name="btnEt" type="submit" class="btn btn-warning">Novas Turmas Ensino Técnico</button>
                </div>
                <div class="form-actions">
                    <!--Botoes do Form-->
                    <button name="btnEtim" type="submit" class="btn btn-warning">Novas Turmas ETIM</button>
                </div>
            </div>
        </div>
    </div>  
</form>

<?php include 'footer.html' ?>
