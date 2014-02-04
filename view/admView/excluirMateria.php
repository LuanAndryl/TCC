<?php

require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include_once 'topo.php';

$rota = new AplicationRoute();

$retorno = $rota->getParams('materia', 'selectMateria', NULL, "where codMateria={$_GET['codMateria']}");
$curso = $rota->getParams('Curso', 'selectCurso', null, "where codCurso={$retorno[0]['codCurso']}");

if (isset($_REQUEST['btnEx'])) {
    $rota->setParams($_GET['classe'], $_GET['metodo']);
    protegeAcesso::_redirect('Location: relatorioMateria.php');
}
if (isset($_REQUEST['btn'])) {
    protegeAcesso::_redirect('Location: relatorioMateria.php');
}


?>

<form method="post">
    <div class="hero-unit">

        <!-- Dados da Materia -->
        <p class="text-center"> <h4>Curso</h4> <input class="input-xlarge" type="text" value="<?php echo $curso[0]['nomeCurso'] . " | " . $curso[0]['periodoCurso']; ?>" placeholder ="ex: Programação para Internet - PI" disabled="disabled"</p>
        <p class="text-center"> <h4>Nome da Materia</h4> <input class="input-xlarge" type="text" value="<?php echo $retorno[0]['nomeMateria']; ?>" placeholder ="ex: Programação para Internet - PI" disabled="disabled"</p>
        <p class="text-center"> <h4>Ementa de Materia</h4> <textarea name="ementaMateria" placeholder="Descrição rapida sobre a materia" rows="3" cols="1" disabled="disabled" ><?php echo $retorno[0]['ementaMateria'] ?></textarea></p>

        <!-- Botões Form -->
        <div class="form-actions">
            <button type="submit" name="btnEx" value="excluir" class="btn btn-danger">Excluir</button>
            <input class="btn" type='button' value='Cancelar' onclick="window.location = 'relatorioMateria.php'">
        </div>
    </div>  
</form>
<?php include 'footer.html' ?>