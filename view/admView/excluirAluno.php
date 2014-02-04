<?php

require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include_once 'topo.php';

$rota = new AplicationRoute();

$retorno = $rota->getParams('Aluno', 'selectAluno', NULL, "where codAluno={$_GET['codAluno']}");
if (isset($_REQUEST['btnAt'])) {
    $rota->setParams($_GET['classe'], $_GET['metodo']);
    protegeAcesso::_redirect('Location: relatorioAluno.php');
}
include 'topo.php';
?>
<form method="post">
    <div class="hero-unit">

        <!-- Formularios Simples -->

        <p class="text-center"> <h4>Nome do Aluno</h4> <input class="input-xlarge" name="nomeAluno" value="<?php echo $retorno[0]['nomeAluno'] ?>" type="text"placeholder ="ex: João Pereira Souza da Cunha Junior" disabled="disabled"</p>
        <p class="text-center"> <h4>Data de Nascimento</h4> <input class="input-medium" name="dataNascAluno" value="<?php echo $retorno[0]['dataNascAluno'] ?>" type="text"placeholder ="ex: dd/mm/aaaa" disabled="disabled"</p>
        <p class="text-center"> <h4>Rg do Aluno</h4> <input class="input-large" name="rgAluno" value="<?php echo $retorno[0]['rgAluno'] ?>" type="text"placeholder ="ex:457849833" disabled="disabled" </p>
        <p class="text-center"> <h4>Email do Aluno</h4> <input class="input-xlarge" name="emailAluno" value="<?php echo $retorno[0]['emailAluno'] ?>" type="text"placeholder ="ex: joaosouza@hotmail.com" disabled="disabled"</p>
        <p class="text-center"> <h4>Email do Responsavel</h4> <input class="input-xlarge" name="emailResponsavel" value="<?php echo $retorno[0]['emailResponsavelAluno'] ?>" type="text"placeholder ="ex: responsaveldoaluno@hotmail.com" disabled="disabled" </p>
        <p class="text-center"> <h4>Telefone do Responsavel</h4> <input class="input-medium" name="telefoneResponsavel" value="<?php echo $retorno[0]['telefoneResponsavelAluno'] ?>"  type="text"placeholder ="ex: 14 3322-4455" disabled="disabled"</p>

        <!-- Botões do Form -->

        <div class="form-actions">
            <button type="submit" name="btnAt" value="Atualizar" class="btn btn-danger">Excluir</button>
            <input class="btn" type='button' value='Cancelar' onclick="window.location = 'relatorioAluno.php'">
        </div>
    </div>
</form>
<?php include 'footer.html' ?>