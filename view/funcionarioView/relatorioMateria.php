<?php
require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include_once 'topo.php';

$rota = new AplicationRoute();
$retorno = $rota->getParams('Materia', 'selectRead');

if (isset($_REQUEST['btnBusca'])) {
    if ($_POST['campo'] == 'naoClicar') {
        echo "<script language=javascript>
                                alert('Escolha uma opçao');
                        </script>";
        //echo '<p class="text-right"><h4>Escolha uma opção</h4></p>';
    } else {
        $retorno = $rota->getParams('Materia', 'selectSearch');
    }
}
if (isset($_REQUEST['btnLimpa']))
    $retorno = $rota->getParams('Materia', 'selectRead');
if (isset($_REQUEST['btnNovo']))
    protegeAcesso::_redirect("Location: cadastroMateria.php");

if (isset($_REQUEST['order'])) {
    $retorno = $rota->getParams('Materia', 'selectOrder');
}
if (isset($_REQUEST['desorder'])) {
    $retorno = $rota->getParams('Materia', 'selectRead');
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
                    <option value="curso.periodoCurso">Periodo Curso</option>
                    <option value="curso.classificacao">Classificação</option>
                    <option value="materia.nomeMateria">Nome Materia</option>
                </select>
            </div>
            <p class="text-right">
                <button type="submit" name="btnBusca" class="btn btn-primary">Buscar</button>
                <button type="submit" name="btnLimpa" class="btn btn-primary">Limpar</button>
                <button type="submit" name="btnNovo" class="btn btn-primary">Novo</button>
            </p>
            <table class="table">
                <tr>
                    <th>Ação <button type="submit" name="desorder" value="codTurma"><i class=" icon-chevron-down"></i></button></th>
                    <th>Classificação <button type="submit" name="order" value="curso.classificacao"><i class=" icon-chevron-down"></i></button></th>
                    <th>Curso <button type="submit" name="order" value="curso.nomeCurso"><i class=" icon-chevron-down"></i></button></th>
                    <th>Periodo <button type="submit" name="order" value="curso.periodoCurso"><i class=" icon-chevron-down"></i></button></th>
                    <th>Nome Materia <button type="submit" name="order" value="materia.nomeMateria"><i class=" icon-chevron-down"></i></button></th>
                    <th>Ementa Materia <button type="submit" name="order" value="materia.ementaMateria"><i class=" icon-chevron-down"></i></button></th>
                </tr>

                <tr>
                    <?php foreach ($retorno as $r => $valor) { ?>
                    <tr class='changeColor'>
                        <td>
                            <input class="btn-mini btn-warning" type='button' value='Editar' onclick="window.location = 'editarMateria.php?classe=Materia&metodo=editarMateria&codMateria=<?php echo $valor['codMateria'] ?>&codCurso=<?php echo $valor['codCurso'] ?>'"> 
                            <input class="btn-mini btn-danger" type='button' value='Excluir' onclick="window.location = 'excluirMateria.php?classe=Materia&metodo=deletarMateria&codMateria=<?php echo $valor['codMateria'] ?>'"> 
                        </td>
                        <td><?php echo $valor['classificacao']; ?></td>
                        <td><?php echo $valor['nomeCurso'] ?></td>
                        <td><?php echo $valor['periodoCurso'] ?></td>
                        <td><?php echo $valor['nomeMateria'] ?></td>
                        <td><?php echo $valor['ementaMateria'] ?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>

    </div>  
</form>


<?php include 'footer.html' ?>
