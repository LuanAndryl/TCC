<?php

require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include_once 'topo.php';

$rota = new AplicationRoute();

$retorno = $rota->getParams('Professor', 'selectProfActive', NULL, "codProf={$_GET['codProf']}");
if (isset($_REQUEST['btnAt'])) {
    $rota->setParams($_GET['classe'], $_GET['metodo']);
    protegeAcesso::_redirect('Location: relatorioProfessorInativo.php');
}
?>
<form method="post">
    <div class="hero-unit">
        <!-- Formularios simples -->
        <p class="text-center"> <h4>Nome do Professor</h4> <input class="input-xxlarge" type="text"name="nomeProf" value="<?php echo $retorno[0]['nomeProf'] ?>"placeholder ="ex: João Pereira Souza da Cunha" disabled="disabled"</p>
        <p class="text-center"> <h4>Email do Professor</h4> <input class="input-xlarge" type="text" name="emailProf" value="<?php echo $retorno[0]['emailProf'] ?>" placeholder ="ex: joaosouza@hotmail.com" disabled="disabled"</p>
        <p class="text-center"> <h4>Matricula do Professor no Centro</h4> <input class="input-medium" type="text" name="matriculaProf" value="<?php echo $retorno[0]['matriculaProf'] ?>" placeholder ="ex: 183947-3" disabled="disabled"</p>

        <!-- Botões do Form -->
        <div class="form-actions">
            <button type="submit" name="btnAt" value="Atualizar" class="btn btn-danger">Desativar</button>
            <input class="btn" type='button' value='Cancelar' onclick="window.location = 'relatorioProfessorAtivo.php'">
        </div>
    </div>
</form>
<?php include 'footer.html' ?>