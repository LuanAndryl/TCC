<?php
require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include_once 'topo.php';

$rota = new AplicationRoute();

$matricula = $rota->getParams('Matricula', 'selectMatricula', $_GET['situacao']);
if (isset($_REQUEST['btnSalvar'])) {
    protegeAcesso::_redirect("Location: preRelatorioMatriculaMateria.php?codTurma={$_GET['codTurma']}&codCurso={$_GET['codCurso']}&situacao={$_GET['situacao']}");
}

include 'menuRelatorio.html';
?>
<form method="post">
    <div class="hero-unit">
        <div class="row-fluid">
            <input class="input-block-level search-query" type="text" placeholder="Digite sua Busca">
            <br><br>
            <div class="span8">
                <select>
                    <option>Pesquisar Por</option>
                    <option value="aluno">Nome</option>
                    <option value="materia">Matéria</option>
                </select>
            </div>
            <p class="text-right">


                <input class="btn btn-primary" type='button' value='Nova' onclick="window.location = 'cadastroMatricula.php?codTurma=<?php echo $_GET['codTurma'] ?>&codCurso=<?php echo $_GET['codCurso'] ?>'">
                <input class="btn btn-inverse" type='button' value='Situação' onclick="window.location = 'selectSituacao.php?codTurma=<?php echo $_GET['codTurma'] ?>&codCurso=<?php echo $_GET['codCurso'] ?>&codMateria=<?php echo $_GET['codMateria'] ?>'">

            </p>
            <table class="table">
                <tr>
                    <th>Ação</th>
                    <th>Nome Aluno</th>
                    <th>Matéria</th>
                </tr>
                <?php foreach ($matricula as $m => $valor) { ?>
                    <tr class="changeColor" >
                        <td>
                            <input class="btn-mini btn-warning" type='button' value='Editar' onclick="window.location = 'editarMatricula.php?codTurma=<?php echo $_GET['codTurma'] ?>&codAluno=<?php echo $valor['codAluno'] ?>&codMateria=<?php echo $valor['codMateria'] ?>&situacao=<?php echo $_GET['situacao'] ?>&codCurso=<?php echo $_GET['codCurso'] ?> '"> 
                        </td>
                        <td><?php echo $valor['nomeAluno']; ?></td>
                        <td><?php echo $valor['nomeMateria']; ?></td>
                    </tr>
                <?php } ?>
            </table>
            <div class="form-actions">
                <button name="btnSalvar" type="submit" class="btn" >Voltar</button>
            </div>
        </div>

    </div>      
</form>
<?php include 'footer.html' ?>
