<?php
require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include_once 'topo.php';

$rota = new AplicationRoute();

$retorno = $rota->getParams('Professor', 'selectProfessor', NULL, " WHERE codProf={$_GET['codProf']}");
if (isset($_REQUEST['btnAt'])) {
    $rota->setParams($_GET['classe'], $_GET['metodo']);
    if ($retorno[0]['statusProf'] == '1') {
        protegeAcesso::_redirect('Location: relatorioProfessorAtivo.php');
        exit();
    } else {
        protegeAcesso::_redirect('Location: relatorioProfessorInativo.php');
        exit();
    }
}
if (isset($_REQUEST['btnLimpar']))
    if ($retorno[0]['statusProf'] == '1') {
        protegeAcesso::_redirect('Location: relatorioProfessorAtivo.php');
        exit();
    } else {
        protegeAcesso::_redirect('Location: relatorioProfessorInativo.php');
        exit();
    }
?>
<form method="post">
    <div class="hero-unit">
        <!-- Formularios simples -->
        <div class="control-group">
            <h4>Nome do Professor</h4>
            <input class="input-xxlarge" type="text" name="nomeProf" value="<?php echo $retorno[0]['nomeProf'] ?>" required data-required data-pattern="[a-zA-Z]{0,40}"/>
        </div>
        <div class="control-group">
            <h4>Email do Funcionario</h4>
            <input class="input-xlarge" type="text" name="emailProf" value="<?php echo $retorno[0]['emailProf'] ?>" required data-required data-pattern="^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{1,3})+$"/>
        </div>
        <div class="control-group">
            <h4>Matricula do Professor no Centro</h4>
            <input class="input-medium" name="matriculaProf" type="text" value="<?php echo $retorno[0]['matriculaProf'] ?>"  required data-required data-pattern="[0-9]{4}-[0-9]{1}"/>
        </div>
        <div class="control-group">
            <h4>Senha do Funcionario</h4> 
            <input type="password" class="input-medium" name="senhaProf" value="<?php echo $retorno[0]['senhaProf'] ?>" required data-required data-pattern="^[0-9]+$"/>
        </div>
    </div>
    <!-- Botões do Form -->

    <div class="form-actions">
        <button type="submit" name="btnAt" value="Atualizar" class="btn btn-warning">Atualizar</button>
        <input name="btnLimpar" type="submit" value="Cancelar" class="btn">
    </div>
</div>
</form>
<?php include 'footer.html' ?>