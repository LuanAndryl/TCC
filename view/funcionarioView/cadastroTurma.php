<?php
require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include_once 'topo.php';

$rota = new AplicationRoute();
$cursoEs = $rota->getParams('Curso', 'selectCurso');
if (isset($_REQUEST['btnSalvar'])) {
    $rota->setParams($_REQUEST['classe'], $_REQUEST['metodo']);
    protegeAcesso::_redirect('Location: relatorioTurma.php');
}
if (isset($_REQUEST['btnLimpar']))
    protegeAcesso::_redirect('Location: relatorioTurma.php');

?>
<form method="post">
    <div class="hero-unit">
        <!-- Botao dropdown dos cursos -->	
        <!--<h4>Nome do Curso</h4>
        <select>
            <option></option>
        </select> -->
        <!-- Fomularios simples -->
        <select name="codCurso">
            <option value="<?php echo $cursoEs[0]['codCurso'] ?>"><?php echo $cursoEs[0]['nomeCurso'] . " - " . $cursoEs[0]['periodoCurso'] ?></option>
            <?php foreach ($cursoEs as $key => $value) { ?>
                <option value="<?php echo $value['codCurso'] ?>"><?php echo $value['nomeCurso'] . " - " . $value['periodoCurso'] ?></option>
            <?php } ?>
        </select>
        <select name="semestre">
            <option >1ºSemestre</option>
            <option >2ºSemestre</option>
        </select>
        <p class="text-center"> <h4>Modulo Turma</h4> <input class="input-large" name="moduloTurma" type="text"placeholder ="ex: Primeiro ou Modulo" value="<?php $modulo ?>"</p>
        <p class="text-center"> <h4>Prefixo Turma</h4> <input class="input-small" name="prefixoTurma" type="text"placeholder ="ex: A ou 1" value="<?php $prefixo ?>"</p>
        <input type="hidden" name="classe" value="Turma">
        <input type="hidden" name="metodo" value="addTurma">
        <div class="form-actions">
            <!--Botoes do Form-->
            <button name="btnSalvar" type="submit" class="btn btn-primary">Salvar</button>
            <input name="btnLimpar" type="submit" value="Cancelar" class="btn">
        </div>
    </div>
</form>


<?php include 'footer.html' ?>