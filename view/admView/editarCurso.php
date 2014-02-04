<?php

require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include_once 'topo.php';

$rota = new AplicationRoute();

$retorno = $rota->getParams('Curso', 'selectCurso', NULL, "where codCurso={$_GET['codCurso']}");
if (isset($_REQUEST['btnAt'])) {
    protegeAcesso::_redirect('Location: relatorioCurso.php');
    $rota->setParams($_GET['classe'], $_GET['metodo']);
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
            <input class="input-xlarge" name="nomeCurso" value="<?php echo $retorno[0]['nomeCurso'] ?>" type="text" required data-required data-pattern="[a-zA-Z]{0,40}"/>
        </div>
        <h4>Periodo Curso</h4>
        <select name="periodoCurso">
            <option>Matutino</option>
            <option>Vespertino</option>
            <option>Noturno</option>
            <option>Integral</option>
        </select>

        <!-- Botões do Form -->

        <div class="form-actions">
            <button type="submit" name="btnAt" value="Atualizar" class="btn btn-warning">Atualizar</button>
            <input class="btn" type='button' value='Cancelar' onclick="window.location = 'relatorioCurso.php'">
        </div>
    </div>
</form>
<?php include 'footer.html' ?>