<?php
require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include_once 'topo.php';

$rota = new AplicationRoute();
$cursoEs = $rota->getParams('Curso', 'selectCurso', null, "WHERE classificacao LIKE  'Ensino Técnico%'");
if (isset($_REQUEST['btnSalvar'])) {
    $rota->setParams('Turma', 'addTurma');
    protegeAcesso::_redirect('Location: relatorioTurma.php');
}
?>
<form method="post">
    <div class="hero-unit">
        <div class="row-fluid">
            <div class="span6">
                <p class="text-center"> <h4>Classificação</h4> <input disabled class="input-xlarge" value="Ensino Técnico" name="classificacao" type="text"placeholder ="ex: Ensino Regular"> </p>
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

                    <h4>Semestre Turma</h4>
                    <select name="semestre">
                        <option >1º Semestre</option>
                        <option >2º Semestre</option>
                    </select>
                    <p class="text-center"> <h4>Prefixo</h4>
                    <select name="prefixoTurma">
                        <option value="1º">1º</option>
                        <option value="2º">2º</option>
                        <option value="3º">3º</option>
                        <option value="4º">4º</option>
                        <option value="5º">5º</option>
                    </select>

                    <p class="text-center"> <h4>Turma</h4>
                    <select name="moduloTurma">
                        <option value="Modulo">Modulo</option>                       
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