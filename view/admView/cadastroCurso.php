<?php
require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include_once 'topo.php';

$rota = new AplicationRoute();

if (isset($_REQUEST['btnSalvar'])) {
    $rota->setParams($_REQUEST['classe'], $_REQUEST['metodo']);
    protegeAcesso::_redirect('Location: relatorioCurso.php');
}

?>
<form method="post">
    <div class="hero-unit">

        <!-- Formularios Dados do Curso -->
        <h4>Classificação do Curso</h4>
        <select name="classificacao">
            <option>Ensino Regular</option>
            <option>Ensino Técnico</option>
            <option>Ensino Técnico Integrado ao Médio</option>
        </select>
        <div class="control-group">
            <h4>Nome do Curso</h4> 
            <input class="input-xlarge" name="nomeCurso" type="text"placeholder ="ex: Informatica" required data-required data-pattern="[a-zA-Z]{0,40}" />
        </div>
        <h4>Periodo Curso</h4>
        <select name="periodoCurso">
            <option>Matutino</option>
            <option>Vespertino</option>
            <option>Noturno</option>
            <option>Integral</option>
        </select>
        <input type="hidden" name="classe" value="Curso">
        <input type="hidden" name="metodo" value="addCurso">
        <!-- Botões do Form -->

        <div class="form-actions">
            <button name="btnSalvar" type="submit" class="btn btn-primary">Salvar</button>
            <input class="btn" type='button' value='Cancelar' onclick="window.location = 'home.php'">
        </div>
    </div>
</form>
<?php include 'footer.html' ?>         