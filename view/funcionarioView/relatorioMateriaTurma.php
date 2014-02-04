<?php
require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include_once 'topo.php';

$rota = new AplicationRoute();
$matTur = $rota->getParams('MateriaTurma', 'select');

if (isset($_REQUEST['order'])) {
    $matTur = $rota->getParams('MateriaTurma', 'selectOrder');
}
if (isset($_REQUEST['desorder'])) {
    $matTur = $rota->getParams('MateriaTurma', 'select');
}
if (isset($_REQUEST['codMateriaTurma'])) {
    $rota->setParams('MateriaTurma', 'deleteMateriaTurma');
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
                    <option value="curso">Turma</option>
                </select>
            </div>
            <p class="text-right">
                <input class="btn btn-primary" type='button' value='Livres' onclick="window.location = 'cadastroMateriaTurma.php?codCurso=<?php echo $_GET['codCurso'] ?>'"> 
                <button type="submit" class="btn btn-primary">Buscar</button>
            </p>
            <table class="table">
                <tr>
                    <th>Ação<button type="submit" name="desorder" value="curso.nomeCurso"><i class=" icon-chevron-down"></i></button></th>
                    <th>Nome Curso </th>
                    <th>Nome da Turma <button type="submit" name="order" value="turma.moduloTurma"><i class=" icon-chevron-down"></i></button></th>
                    <th>Materias <button type="submit" name="order" value="materia.nomeMateria"><i class=" icon-chevron-down"></i></button></th>
                    <th>Professor <button type="submit" name="order" value="professor.nomeProf"><i class=" icon-chevron-down"></i></button></th>
                </tr>
                <?php foreach ($matTur as $m => $valor) { ?>
                    <tr class="changeColor">
                        <td>                           
                            <input class="btn-mini btn-warning" type='button' value='Editar' onclick="window.location = 'efetuarEditarMateriaTurma.php?codCurso=<?php echo $valor['codCurso'] ?>&codMateria=<?php echo $valor['codMateria'] ?>&codTurma=<?php echo $valor['codTurma'] ?>'"> 
                            <button name="codMateriaTurma" value="<?php echo $valor['codMateriaTurma'] ?>" type="submit" class="btn-mini btn-danger">Excluir</button>
                        </td>
                        <td><?php echo $valor['nomeCurso'] . " - " . $valor['periodoCurso'] ?></td>
                        <td><?php echo $valor['moduloTurma'] . " " . $valor['prefixoTurma'] ?></td>
                        <td>
                            <?php echo $valor['nomeMateria'] ?>
                        </td>
                        <td>
                            <?php echo $valor['nomeProf'] ?>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>

    </div>      
</form>

<?php include 'footer.html'; ?>

