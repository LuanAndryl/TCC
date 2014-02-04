<?php
require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include_once 'topo.php';
$rota = new AplicationRoute();

if (isset($_REQUEST['btnSalvar'])) {
    $rota->setParams($_REQUEST['classe'], $_REQUEST['metodo']);

    if ($_POST['status'] == '1')
        protegeAcesso::_redirect('Location: relatorioAlunoAtivo.php');
    else
        protegeAcesso::_redirect('Location: relatorioAlunoInativo.php');
}
if (isset($_REQUEST['btnLimpar']))
    protegeAcesso::_redirect('Location: relatorioAlunoAtivo.php');

?>
<form id="oi" method="post">
    <div class="hero-unit">     
        <!-- Formularios Simples -->
        <div class="control-group">
            <h4>Nome do Aluno</h4>
            <input class="input-xlarge" name="nomeAluno" type="text" placeholder ="ex: João Pereira Souza da Cunha Junior" required data-required data-pattern="[a-zA-Z]{0,40}"/>
        </div>
        <div class="control-group">
            <h4>Data de Nascimento</h4> 
            <input class="input-medium" id="nascimento" name="dataNascAluno" type="text"  placeholder ="ex: 31/12/2099" required data-required data-pattern="(((0[1-9]|[12][0-9]|3[01])([/])(0[13578]|10|12)([/])(\d{4}))|(([0][1-9]|[12][0-9]|30)([/])(0[469]|11)([/])(\d{4}))|((0[1-9]|1[0-9]|2[0-8])([/])(02)([/])(\d{4}))|((29)(\.|-|\/)(02)([/])([02468][048]00))|((29)([/])(02)([/])([13579][26]00))|((29)([/])(02)([/])([0-9][0-9][0][48]))|((29)([/])(02)([/])([0-9][0-9][2468][048]))|((29)([/])(02)([/])([0-9][0-9][13579][26])))"/>
        </div>
        <div class="control-group">
            <h4>Rg do Aluno</h4> 
            <input class="input-large" id="rg" name="rgAluno" type="text" placeholder ="ex:45.784.983-3" required data-required data-pattern="^[0-9]{2}\.[0-9]{3}\.[0-9]{3}-[0-9A-Za-z]{1}$"/>
        </div>
        <div class="control-group">
            <h4>Email do Aluno</h4>
            <input class="input-xlarge" name="emailAluno" type="text" required placeholder="ex: aluno@hotmail.com" required data-required data-pattern="^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{1,3})+$"/>
        </div>
        <div class="control-group">
            <h4>Telefone do Responsavel</h4>
            <input class="input-medium" id="tel" name="telefoneR" type="text" placeholder ="ex: (14) 3322-4455" required data-required data-pattern="^\(\d{2}\)[\s-]?\d{4}-?\d{4}$"/>
        </div>
        <div class="control-group">
            <h4>Email do Responsavel</h4> 
            <input class="input-xlarge" name="emailResponsavelAluno" type="email" placeholder ="ex: responsaveldoaluno@hotmail.com" required data-required data-pattern="^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{1,3})+$"/>
        </div>
        <h4>Status do Aluno</h4>
        <select name="status">
            <option value="1">Ativo</option>
            <option value="2">Inativo</option>
        </select>
        <input type="hidden" name="classe" value="Aluno">
        <input type="hidden" name="metodo" value="addAluno">
        <!-- Botões do Form -->

        <div class="form-actions">
            <button name="btnSalvar" type="submit" class="btn btn-primary">Salvar</button>
            <input name="btnLimpar" type="submit" value="Cancelar" class="btn">
        </div>
    </div>
</form>
<?php include 'footer.html' ?>