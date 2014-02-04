<?php
require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include_once 'topo.php';

$rota = new AplicationRoute();

$retorno = $rota->getParams('Funcionario', 'selectFunc', NULL, "where codFunc={$_GET['codFunc']}");
if (isset($_REQUEST['btnAt'])) {
    $rota->setParams($_GET['classe'], $_GET['metodo']);
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
            <input class="input-xxlarge" name="nomeFunc" value="<?php echo $retorno[0]['nomeFunc']; ?>" type="text" required data-required data-pattern="[a-zA-Z]{0,40}"/>
        </div>
        <div class="control-group">
            <h4>Login do Funcionario</h4>
            <input class="input-medium" name="loginFunc" value="<?php echo $retorno[0]['loginFunc']; ?>" type="text" required data-required data-pattern="[a-zA-Z]{0,40}"/>
        </div>
        <div class="control-group">
            <h4>Senha do Funcionario</h4>
            <input type="password" class="input-medium" name="senhaFunc" value="<?php echo $retorno[0]['senhaFunc']; ?>" required data-required data-pattern="^[0-9]+$"/>
        </div>
        <!-- Botões do Form -->
        <div class="form-actions">
            <button type="submit" name="btnAt" value="Atualizar" class="btn btn-warning">Atualizar</button>
            <input class="btn" type='button' value='Cancelar' onclick="window.location = 'relatorioFuncionario.php'">
        </div>
    </div>
</form>
<?php include 'footer.html' ?>