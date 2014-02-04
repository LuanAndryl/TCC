<?php

require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include_once 'topo.php';

$rota = new AplicationRoute();
$retorno = $rota->getParams('Turma', 'selectTurma', NULL, "where codTurma={$_GET['codTurma']}");
$cursoEs = $rota->getParams('Curso', 'selectCurso', null, "WHERE codCurso ={$_GET['codCurso']} ");
$curso = $rota->getParams('Curso', 'selectCurso');
if (isset($_REQUEST['btnAt'])) {
    $rota->setParams($_GET['classe'], $_GET['metodo']);
    protegeAcesso::_redirect('Location: relatorioTurma.php');
}
if (isset($_REQUEST['btn'])) {
    protegeAcesso::_redirect('Location: relatorioTurma.php');
}

?>
<form method="post">
    <div class="hero-unit">
        <!-- Botao dropdown dos cursos -->
        <h4>Classificação do Curso</h4>
        <select name="classificacao">
            <option value="1">Ensino Regular</option>
            <option value="2">Ensino Técnico</option>
            <option value="3">Ensino Técnico Integrado ao Médio</option>
        </select>
        <p class="text-center"> <h4>Nome Curso</h4>
        <select name ="opcao">
            <option value="<?php echo $cursoEs[0]['codCurso'] ?>"><?php echo $cursoEs[0]['nomeCurso'] . " | " . $cursoEs[0]['periodoCurso'] ?></option>
            <?php foreach ($curso as $k => $v) { ?>
                <option value="<?php echo $v['codCurso'] ?>"><?php echo $v['nomeCurso'] . " " . $v['periodoCurso']; ?></option>
            <?php }
            ?>
        </select>
        <!-- Fomularios simples -->
        <p class="text-center"> <h4>Turma</h4>
        <select name="moduloTurma">
            <option value="Primeiro">Primeiro</option>
            <option value="Segundo">Segundo</option>
            <option value="Terceiro">Terceiro</option>
        </select>

        <p class="text-center"> <h4>Prefixo</h4>
        <select name="prefixoTurma">
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
        </select>
        <div class="form-actions">
            <button type="submit" name="btnAt" value="Atualizar" class="btn btn-warning">Atualizar</button>
            <input class="btn" type='button' value='Cancelar' onclick="window.location = 'relatorioTurma.php'">
        </div>
    </div>
</div>
</form>

<?php include 'footer.html' ?>