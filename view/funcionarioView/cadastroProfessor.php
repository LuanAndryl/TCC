<?php
require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include_once 'topo.php';

$rota = new AplicationRoute();
if (isset($_REQUEST['btnSalvar'])) {
    $rota->setParams($_REQUEST['classe'], $_REQUEST['metodo']);
    if ($_POST['status'] == '1')
        protegeAcesso::_redirect('Location: relatorioProfessorAtivo.php');
    else
        protegeAcesso::_redirect('Location: relatorioProfessorInativo.php');
}
if (isset($_REQUEST['btnLimpar']))
    protegeAcesso::_redirect('Location: relatorioProfessorAtivo.php');

?>
<form method="post">
    <div class="hero-unit">
        <!-- Formularios simples -->
        <div class="control-group">
            <h4>Nome do Professor</h4>
            <input class="input-xxlarge" type="text" name="nomeProf" placeholder ="ex: Vera Hypolito" required data-required data-pattern="[a-zA-Z]{0,40}"/>
        </div>
        <div class="control-group">
            <h4>Email do Funcionario</h4>
            <input class="input-xlarge" type="text" name="emailProf" placeholder ="ex: vera_hypolito@hotmail.com" required data-required data-pattern="^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{1,3})+$"/>
        </div>
        <div class="control-group">
            <h4>Matricula do Professor no Centro</h4>
            <input class="input-medium" id="inscrCentro" name="matriculaProf" type="text" placeholder ="ex: 1234-5" required data-required data-pattern="[0-9]{4}-[0-9]{1}"/>
        </div>
        <div class="control-group">
            <h4>Senha do Funcionario</h4> 
            <input type="password" class="input-medium" name="senhaProf" max="20" placeholder ="ex: 12345" required data-required data-pattern="^[0-9]+$"/>
        </div>
        <select name="status">
            <option value="1">Ativo</option>
            <option value="2">Inativo</option>
        </select>
        <input type="hidden" name="classe" value="Professor">
        <input type="hidden" name="metodo" value="addProfessor">
        <div class="form-actions">
            <!--Botoes do Form-->
            <button name="btnSalvar" type="submit" class="btn btn-primary">Salvar</button>
            <button name="btnLimpar" type="subimit" class="btn">Cancelar</button>
        </div>
    </div>
</form>


<?php include 'footer.html' ?>