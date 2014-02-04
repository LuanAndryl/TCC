<?php
require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include_once 'topo.php';

$rota = new AplicationRoute();

if (!empty($_GET['codCurso']))
    $cursoEs = $rota->getParams('Curso', 'selectCurso', null, "where codCurso={$_GET['codCurso']}");
else
    $cursoEs = $rota->getParams('Curso', 'selectCurso');

if (isset($_REQUEST['btnSalvar'])) {
    $rota->setParams($_REQUEST['classe'], $_REQUEST['metodo']);
    protegeAcesso::_redirect('Location: relatorioMateria.php');
}

?>
<form method="post">
    <div class="hero-unit">

        <p class="text-center"> <h4>Curso</h4>
        <select name="opcao">
            <?php if (!empty($_GET['codCurso'])) { ?>
                <option value="<?php echo $cursoEs[0]['codCurso'] ?>"><?php echo $cursoEs[0]['nomeCurso'] . " - " . $cursoEs[0]['periodoCurso'] ?></option>
            <?php } else { ?>
                <option value="<?php echo $cursoEs[0]['codCurso'] ?>"><?php echo $cursoEs[0]['nomeCurso'] . " - " . $cursoEs[0]['periodoCurso'] ?></option>
            <?php } ?>
            <?php foreach ($cursoEs as $key => $value) { ?>
                <option value="<?php echo $value['codCurso'] ?>"><?php echo $value['nomeCurso'] . " - " . $value['periodoCurso'] ?></option>
            <?php } ?>
        </select>
        <div class="control-group">
            <h4>Nome da Materia</h4> 
            <input class="input-xlarge" name="nomeMateria" type="text"placeholder ="ex: LPL" required data-required data-pattern="[a-zA-Z]{0,40}"/>
        </div>
        <div class="control-group">
            <h4>Ementa de Materia</h4> 
            <textarea name="ementaMateria" placeholder="Descrição rapida sobre a materia" rows="3" cols="1" data-required="true"></textarea>
        </div>
        <input type="hidden" name="classe" value="Materia">
        <input type="hidden" name="metodo" value="addMateria">
        <div class="form-actions">
            <!--Botoes do Form-->
            <button name="btnSalvar" type="submit" class="btn btn-primary">Salvar</button>
            <input class="btn" type='button' value='Cancelar' onclick="window.location = 'home.php'">
        </div>
    </div>
</form>


<?php include 'footer.html' ?>