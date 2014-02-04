<?php
require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include 'topo.php';
$rota = new AplicationRoute();
$materia = $rota->getParams('Chamada', 'selectMateriaByProf');
if (isset($_REQUEST['btnSalvar'])) {
    protegeAcesso::_redirect("Location: preChamada.php?codMateria={$_POST['materia']}&codProf={$prof[0]['codProf']}");
}
if (isset($_REQUEST['btnLimpar']))
    protegeAcesso::_redirect('Location: relatorioProfessorAtivo.php');
?>
<form method="post">
    <div class="hero-unit">

        <!-- Formularios Simples -->
        <p class="text-center">
            <!-- Aqui puxa so as turmas que aquele professor ministra aula saca !-->
        <h4>Selecione a materia</h4>

        <select name="materia"> 
            <?php foreach ($materia as $m => $valor) { ?>
                <option value="<?php echo $valor['codMateria'] ?>"><?php echo $valor['nomeMateria'] ?></option>
            <?php } ?>
        </select>

        <!-- Botões do Form -->
        <div class="form-actions">
            <!--Botoes do Form-->
            <button name="btnSalvar" type="submit" class="btn btn-info">Proximo</button>
            <button name="btnLimpar" type="submit" class="btn">Cancelar</button>
        </div>
    </div>
</form>
<?php include 'footer.html' ?>