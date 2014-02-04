<?php
require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include_once 'topo.php';

$rota = new AplicationRoute();
if (isset($_REQUEST['btnSalvar'])) {
    $rota->setParams($_REQUEST['classe'], $_REQUEST['metodo']);
    protegeAcesso::_redirect('Location: relatorioFuncionario.php');
}
if (isset($_REQUEST['btnLimpar']))
    protegeAcesso::_redirect('Location: relatorioFuncionario.php');

?>

<form method="post">
    <div class="hero-unit">

        <!-- Dados do Funcionario --> 

        <div class="control-group">
            <h4>Nome do Funcionario</h4>
            <input class="input-xxlarge" name="nomeFunc" type="text"placeholder ="ex: João Pereira Souza da Cunha" required data-required data-pattern="[a-zA-Z]{0,40}"/>
        </div>
        <div class="control-group">
            <h4>Login do Funcionario</h4>
            <input class="input-medium" name="loginFunc" type="text"placeholder ="ex: joaosouza" required data-required data-pattern="[a-zA-Z]{0,40}"/>
        </div>
        <div class="control-group">
            <h4>Senha do Funcionario</h4>
            <input type="password" class="input-medium" name="senhaFunc" placeholder="ex: 12345" required data-required data-pattern="^[0-9]+$"/>
        </div>
        <input type="hidden" name="classe" value="Funcionario">
        <input type="hidden" name="metodo" value="addFunc">
        <!-- Botões do Form -->
        <div class="form-actions">
            <button name="btnSalvar" type="submit" class="btn btn-primary">Salvar</button>
            <input name="btnLimpar" type="submit" value="Cancelar" class="btn">
        </div>
    </div>
</form>
<?php include 'footer.html' ?>