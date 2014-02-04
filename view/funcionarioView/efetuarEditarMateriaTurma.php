<?php
require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include_once 'topo.php';

$rota = new AplicationRoute();
$turma = $rota->getParams('Turma', 'selectTurma', null, "where codCurso={$_GET['codCurso']}");
$turAt = $rota->getParams('Turma', 'selectTurma', null, "where codTurma={$_GET['codTurma']}");
$professor = $rota->getParams('Professor', 'selectProfActive');
$materia = $rota->getParams('Materia', 'selectMateria', null, "where codMateria={$_GET['codMateria']}");
$curso = $rota->getParams('Curso', 'selectCurso', null, "where codCurso={$_GET['codCurso']}");
$matTurProf = $rota->getParams('MateriaTurma', 'selectProfByMatAndTurma');

if (isset($_REQUEST['btnBusca'])) {
    if ($_POST['opcao'] == 'naoClicar') {
        echo '<p class="text-right"><h4>Escolha uma opção</h4></p>';
    } else {
        $professor = $rota->getParams('Professor', 'selectProfActive', NULL, "{$_POST['opcao']} LIKE  '{$_POST['txtPesq']}%'");
    }
}
if (isset($_REQUEST['btnNovo'])) {
    protegeAcesso::_redirect("Location: cadastroProfessor.php");
    exit();
}
if (isset($_REQUEST['btnLimpa']))
    $professor = $rota->getParams('Professor', 'selectProfActive');
if (isset($_REQUEST['btnIna'])) {
    protegeAcesso::_redirect("Location: relatorioProfessorInativo.php");
    exit();
}

if (isset($_POST['codProf'])) {
    $rota->setParams('MateriaTurma', 'addMateriaTurma');
}
if (isset($_POST['codProfDel'])) {
    $rota->setParams('MateriaTurma', 'deleteMateriaTurmaByProf');
}
if (isset($_POST['codProfSubs'])) {
    $rota->setParams('MateriaTurma', 'editProfMateriaTurma');
}
if (isset($_POST['btnLimpar'])) {
    protegeAcesso::_redirect("Location: relatorioMateriaTurma.php?codTurma={$_GET['codTurma']}&codCurso={$_GET['codCurso']}");
    exit();
}

include 'topo.php';
?>
<form method="post">
    <div class="hero-unit">
        <div class="row-fluid">
            <!-- Combo dropdown das Materias -->
            <h4> Atribuir aulas para: <?php echo "{$materia[0]['nomeMateria']} - Curso: {$curso[0]['nomeCurso']} - {$curso[0]['periodoCurso']} " ?></h4>
            <div class="span12">
                <p class="text-center">
                    <input class="input-block-level search-query" name="txtPesq" type="text" placeholder="Digite sua Busca">
                    <br><br>
                <div class="span6">
                    <select name="opcao">
                        <option value="naoClicar">Pesquisar Por</option>
                        <option value="nomeProf">Nome</option>
                        <option value="matriculaProf">Matricula</option>
                        <option value="emailProf">Email</option>
                    </select>
                </div>
                <p class="text-right">
                    <button type="submit" name="btnBusca" class="btn btn-primary">Buscar</button>
                    <button type="submit" name="btnLimpa" class="btn btn-primary">Limpar</button>
                    <button type="submit" name="btnNovo" class="btn btn-primary">Novo</button>
                    <button type="submit" name="btnIna" class="btn btn-inverse">Professores Inativos</button>
                <div class="form-actions">
                    Professores que ministram a aula
                    <table class=" table ">
                        <tr>
                            <th>Excluir</th>
                            <th>Subs</th>
                            <th>Nome Professor</th>
                            <th>Email Pofessor</a>
                            <th>Matricula Professor</a>
                        </tr>

                        <?php foreach ($matTurProf as $m => $valor) { ?>
                            <tr class="changeColor">
                                <td><button name="codProfDel" value="<?php echo $valor['codProf'] ?>" type="submit" class="btn-mini btn-danger"><i class="icon-remove"></i></button></td>
                                <td><input type="radio" name="radioProf" value="<?php echo $valor['codProf'] ?>"></td>
                                <td><?php echo $valor['nomeProf'] ?> </td>
                                <td><?php echo $valor['emailProf'] ?></td>
                                <td><?php echo $valor['matriculaProf'] ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
                <br/>
                <br/>
                <!-- Combo dropdown dos Professores -->
            </div>
            <div class="span12">
                <table class="table">
                    <tr>
                        <th>Ação</th>
                        <th>Nome Professor</th>
                        <th>Email Pofessor</a>
                        <th>Matricula Professor</a>
                    </tr>
                    <?php foreach ($professor as $r => $valor) {
                        ?>
                        <tr class="changeColor" >
                            <td>
                                <button name="codProfSubs" value="<?php echo $valor['codProf'] ?>" type="submit" class="btn-mini btn-warning">Substituir</button>
                                <button name="codProf" value="<?php echo $valor['codProf'] ?>" type="submit" class="btn-mini btn-primary">Atribuir</button>
                            </td>
                            <td><?php echo $valor['nomeProf'] ?> </td>
                            <td><?php echo $valor['emailProf'] ?></td>
                            <td><?php echo $valor['matriculaProf'] ?></td>

                        </tr>
                    <?php } ?> 
                </table>
            </div>
            <!-- Combo dropdown das Materias -->
        </div>
        <div class="form-actions">
            <!--Botoes do Form-->
            <input name="btnRelatorio" type="submit" value="Relatório" class="btn btn-primary">
            <input name="btnLimpar" type="submit" value="Voltar" class="btn">
        </div>

    </div>
</form>

<?php include 'footer.html' ?>
