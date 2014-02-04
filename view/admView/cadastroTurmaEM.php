<?php
require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include_once 'topo.php';

$rota = new AplicationRoute();
$cursoEs = $rota->getParams('Curso', 'selectCurso', null, "WHERE classificacao LIKE  'Ensino Regular%'");
if (isset($_REQUEST['btnSalvar'])) {
    $rota->setParams('Turma', 'addTurma');
    protegeAcesso::_redirect('Location: relatorioTurma.php');
}
if (isset($_REQUEST['btnLimpar']))
    protegeAcesso::_redirect('Location: relatorioTurma.php');

?>
<form method="post">
    <div class="hero-unit">
        <div class="row-fluid">
            <div class="span6">
                <p class="text-center"> <h4>Classificação</h4> <input disabled class="input-xlarge" value="Ensino Regular" name="classificacao" type="text"placeholder ="ex: Ensino Regular"> </p>
                <input class="btn-small btn-warning" type='button' value='Alterar Classificação' onclick="window.location = 'preCadastroTurma.php'"> 
            </div>
            <div class="span6">
                <p class="text-center"> <h4>Curso</h4>
                <?php if (empty($cursoEs)) { ?>
                    <p class="text-center"> <h4>Nenhum curso cadastrado para esta Classificação</h4>
                    <input class="btn-large btn-primary" type='button' value='Cadastrar' onclick="window.location = 'cadastroCurso.php'"> 
                <?php } else { ?>
                    <select name="codCurso">
                        <?php foreach ($cursoEs as $key => $value) { ?>
                            <option value="<?php echo $value['codCurso'] ?>"><?php echo $value['nomeCurso'] . " - " . $value['periodoCurso'] ?></option>
                        <?php } ?>
                    </select>
                    <input type="hidden" name="semestre" value="1º Semestre" >
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
                        <!--Botoes do Form-->
                        <button name="btnSalvar" type="submit" class="btn btn-primary">Salvar</button>
                        <input class="btn" type='button' value='Cancelar' onclick="window.location = 'home.php'">
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</form>


<?php include 'footer.html' ?>