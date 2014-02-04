<?php
require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include_once 'topo.php';

$rota = new AplicationRoute();
$retorno = $rota->getParams('Turma', 'selectRead');
if (isset($_REQUEST['btnBusca'])) {
    if ($_POST['campo'] == 'naoClicar') {
        echo "<script language=javascript>
                                alert('Escolha uma opçao');
                        </script>";
        //echo '<p class="text-right"><h4>Escolha uma opção</h4></p>';
    } else {
        $retorno = $rota->getParams('Turma', 'selectSearch');
    }
}
if (isset($_REQUEST['btnLimpa']))
    $retorno = $rota->getParams('Turma', 'selectRead');
if (isset($_REQUEST['btnNovo']))
    protegeAcesso::_redirect("Location: preCadastroTurma.php");

if (isset($_REQUEST['order'])) {
    $retorno = $rota->getParams('Turma', 'selectOrder');
}
if (isset($_REQUEST['desorder'])) {
    $retorno = $rota->getParams('Turma', 'selectRead');
}

include 'menuRelatorio.html';
?>
<form method="post">
    <div class="hero-unit">
        <div class="row-fluid">
            <input class="input-block-level search-query" name="txtPesq"type="text" placeholder="Digite sua Busca">
            <br><br>
            <div class="span8">
                <select name="campo">
                    <option value="naoClicar" >Pesquisar Por</option>
                    <option value="curso.classificacao">Classificação</option>
                    <option value="curso.nomeCurso">Nome Curso</option>
                    <option value="curso.periodoCurso">Periodo Turma</option>
                    <option value="curso.classificacao">Classificação</option>
                    <option value="turma.moduloTurma">Nome Turma</option>
                </select>
            </div>
            <p class="text-right">
                <button type="submit" name="btnBusca" class="btn btn-primary">Buscar</button>
                <button type="submit" name="btnLimpa" class="btn btn-primary">Limpar</button>
            </p>
            <table class="table">
                <tr>
                    <th>Ação <button type="submit" name="desorder" value="codTurma"><i class=" icon-chevron-down"></i></button></th>
                    <th>Classificação <button type="submit" name="order" value="curso.classificacao"><i class=" icon-chevron-down"></i></button></th>
                    <th>Curso <button type="submit" name="order" value="curso.nomeCurso"><i class=" icon-chevron-down"></i></button></th>
                    <th>Periodo <button type="submit" name="order" value="curso.periodoCurso"><i class=" icon-chevron-down"></i></button></th>
                    <th>Nome Turma <button type="submit" name="order" value="turma.moduloTurma"><i class=" icon-chevron-down"></i></button></th>

                </tr>
                <tr>
                    <?php foreach ($retorno as $r => $valor) { ?>
                    <tr class ="changeColor">
                        <td>
                            <input class="btn-mini btn-warning" type='button' value='Editar' onclick="window.location = 'editarTurma.php?classe=Turma&metodo=editarTurma&codTurma=<?php echo $valor['codTurma'] ?>&codCurso=<?php echo $valor['codCurso'] ?>'"> 
                            <input class="btn-mini btn-danger" type='button' value='Excluir' onclick="window.location = 'excluirTurma.php?classe=Turma&metodo=deletarTurma&codTurma=<?php echo $valor['codTurma'] ?>'"> 
                        </td>
                        <td><?php echo $valor['classificacao']; ?></td>
                        <td><?php echo $valor['nomeCurso'] ?></td>
                        <td><?php echo $valor['periodoCurso'] ?></td>
                        <td><?php echo $valor['moduloTurma'] . " " . $valor['prefixoTurma']; ?> </td>
                    </tr>
                <?php } ?> 
            </table>
        </div>

    </div>  
</form>

<?php include 'footer.html' ?>
