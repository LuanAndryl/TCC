<?php

require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include_once 'topo.php';

$rota = new AplicationRoute();

$retorno = $rota->getParams('Professor', 'selectProfessor', NULL, "where codProf={$_GET['codProf']}");
if (isset($_REQUEST['btnEx'])) {
    $rota->setParams($_GET['classe'], $_GET['metodo']);
    protegeAcesso::_redirect('Location: relatorioProfessor.php');
}

?>
<form method="post">
    <div class="hero-unit">
        <!-- Formularios simples -->
        <p class="text-center"> <h4>Nome do Professor</h4> <input class="input-xxlarge" name="nomeProf" value="<?php echo $retorno[0]['nomeProf'] ?>" type="text"placeholder ="ex: João Pereira Souza da Cunha" disabled="disabled"</p>
        <p class="text-center"> <h4>Matricula do Professor no Centro</h4> <input class="input-medium" name="matriculaProf" value="<?php echo $retorno[0]['matriculaProf'] ?>" type="text"placeholder ="ex: 183947-3" disabled="disabled"</p>
        <p class="text-center"> <h4>Email do Professor</h4> <input class="input-xlarge" name="emailProf" value="<?php echo $retorno[0]['emailProf'] ?>" type="text"placeholder ="ex: joaosouza@hotmail.com" disabled="disabled"</p>
        <p class="text-center"> <h4>Senha do Professor</h4> <input class="input-medium" type="password" name="senhaProf" value="<?php echo $retorno[0]['senhaProf'] ?>" type="text"placeholder ="ex: c90j3e2ex" disabled="disabled"</p>
        <!-- Botões do Form -->
        <div class="form-actions">
            <button type="submit" name="btnEx" value="excluir" class="btn btn-danger">Excluir</button>
            <input class="btn" type='button' value='Cancelar' onclick="window.location = 'relatorioProfessor.php'">
        </div>
    </div>
</form>
<?php include 'footer.html' ?>