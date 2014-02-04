<?php

require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include_once 'topo.php';

$rota = new AplicationRoute();

$retorno = $rota->getParams('Materia', 'selectMateria', NULL, "where codMateria={$_GET['codMateria']}");
$cursoEs = $rota->getParams('Curso', 'selectCurso', null, "WHERE codCurso ={$_GET['codCurso']} ");
$curso = $rota->getParams('Curso', 'selectCurso');
if (isset($_REQUEST['btnAt'])) {
    $rota->setParams($_GET['classe'], $_GET['metodo']);
    protegeAcesso::_redirect('Location: relatorioMateria.php');
}
?>
<form method="post">

    <div class="hero-unit">

        <!-- Dados da Materia -->
        <select name ="opcao">
            <option value="<?php echo $cursoEs[0]['codCurso'] ?>"><?php echo $cursoEs[0]['nomeCurso'] . " | " . $cursoEs[0]['periodoCurso'] ?></option>
            <?php foreach ($curso as $k => $v) { ?>
                <option value="<?php echo $v['codCurso'] ?>"><?php echo $v['nomeCurso'] . " " . $v['periodoCurso']; ?></option>
            <?php }
            ?>
        </select>
        <div class="control-group">
            <h4>Nome da Materia</h4>
            <input class="input-xlarge" name="nomeMateria" value="<?php echo $retorno[0]['nomeMateria'] ?>" type="text" required data-required data-pattern="[a-zA-Z]{0,40}"/></p>
        </div>
        <div class="control-group">
            <h4>Ementa de Materia</h4>
            <textarea name="ementaMateria"rows="3" cols="1" required="true"><?php echo $retorno[0]['ementaMateria'] ?></textarea>
        </div>
        <!-- Botões Form -->
        <div class="form-actions">
            <button type="submit" name="btnAt"class="btn btn-warning">Atualizar</button>
            <input class="btn" type='button' value='Cancelar' onclick="window.location = 'relatorioMateria.php'">
        </div>
    </div>  
</form>
<?php include 'footer.html' ?>