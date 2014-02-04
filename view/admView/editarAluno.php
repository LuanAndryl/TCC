<?php
require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include_once 'topo.php';

$rota = new AplicationRoute();

$retorno = $rota->getParams('Aluno', 'selectAluno', NULL, "codAluno={$_GET['codAluno']}");
if (isset($_REQUEST['btnAt'])) {
    $rota->setParams($_GET['classe'], $_GET['metodo']);
    if ($retorno[0]['statusAluno'] == '1')
        protegeAcesso::_redirect('Location: relatorioAlunoAtivo.php');
    else
        protegeAcesso::_redirect('Location: relatorioAlunoInativo.php');
}

if (isset($_REQUEST['btnLimpar']))
    if ($retorno[0]['statusAluno'] == '1') {
        protegeAcesso::_redirect('Location: relatorioAlunoAtivo.php');
    }
    else
        protegeAcesso::_redirect('Location: relatorioAlunoInativo.php');
?>
<form method="post">
    <div class="hero-unit">

        <!-- Formularios Simples -->
        <div class="control-group">
            <h4>Nome do Aluno</h4> <input
                class="input-xlarge" name="nomeAluno" value="<?php echo $retorno[0]['nomeAluno'] ?>" type="text" data-required data-pattern="[a-zA-Z]{3,10}"/>
        </div>
        <div class="control-group">
            <h4>Data de Nascimento</h4>
            <input class="input-medium" id="nascimento" name="dataNascAluno" value="<?php echo $retorno[0]['dataNascAluno'] ?>" type="text" data-required data-pattern="(((0[1-9]|[12][0-9]|3[01])([/])(0[13578]|10|12)([/])(\d{4}))|(([0][1-9]|[12][0-9]|30)([/])(0[469]|11)([/])(\d{4}))|((0[1-9]|1[0-9]|2[0-8])([/])(02)([/])(\d{4}))|((29)(\.|-|\/)(02)([/])([02468][048]00))|((29)([/])(02)([/])([13579][26]00))|((29)([/])(02)([/])([0-9][0-9][0][48]))|((29)([/])(02)([/])([0-9][0-9][2468][048]))|((29)([/])(02)([/])([0-9][0-9][13579][26])))"/>
        </div>
        <div class="control-group">
            <h4>Rg do Aluno</h4> 
            <input class="input-large" id="rg" name="rgAluno" value="<?php echo $retorno[0]['rgAluno'] ?>" type="text" data-required data-pattern="^[0-9]{2}\.[0-9]{3}\.[0-9]{3}-[0-9A-Za-z]{1}$"/>
        </div>
        <div class="control-group">
            <h4>Email do Aluno</h4> 
            <input class="input-xlarge" name="emailAluno" value="<?php echo $retorno[0]['emailAluno'] ?>" type="text" data-required data-pattern="^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{1,3})+$"/>
        </div>
        <div class="control-group">
            <h4>Telefone do Responsavel</h4> 
            <input class="input-medium" id="tel" name="telefoneResponsavel" value="<?php echo $retorno[0]['telefoneResponsavelAluno'] ?>"  type="text" data-required data-pattern="^\(?\d{2}\)?[\s-]?\d{4}-?\d{4}$"/>
        </div>
        <div class="control-group">
            <h4>Email do Responsavel</h4> 
            <input class="input-xlarge" name="emailResponsavel" value="<?php echo $retorno[0]['emailResponsavelAluno'] ?>" type="text" data-required data-pattern="^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{1,3})+$"/>
        </div>
        <!-- Botões do Form -->

        <div class="form-actions">
            <button type="submit" name="btnAt" value="Atualizar" class="btn btn-warning">Atualizar</button>
            <input name="btnLimpar" type="submit" value="Cancelar" class="btn">
        </div>
    </div>
</form>
<?php include 'footer.html' ?>