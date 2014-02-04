<?php
require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include_once 'topo.php';

$rota = new AplicationRoute();

$retorno = $rota->getParams('Curso', 'selectCurso');

if (isset($_REQUEST['btnBusca'])) {
    if ($_POST['opcao'] == 'naoClicar') {
        echo '<p class="text-right"><h4>Escolha uma opção</h4></p>';
    }
    else
        $retorno = $rota->getParams('Curso', 'selectCurso', NULL, "WHERE {$_POST['opcao']} LIKE  '%{$_POST['txtPesq']}%'");
}
if (isset($_REQUEST['btnLimpa']))
    $retorno = $rota->getParams('Curso', 'selectCurso');
if (isset($_REQUEST['btnNovo']))
    protegeAcesso::_redirect("Location: cadastroCurso.php");

if (isset($_REQUEST['order'])) {
    $retorno = $rota->getParams('Curso', 'selectOrder');
}
if (isset($_REQUEST['desorder'])) {
    $retorno = $rota->getParams('Curso', 'selectCurso');
}

include 'menuRelatorio.html';
?>
<form method="post">
    <div class="hero-unit">
        <div class="row-fluid">
            <input class="input-block-level search-query" name="txtPesq" type="text" placeholder="Digite sua Busca">
            <br><br>
            <div class="span8">
                <select name="opcao">
                    <option value="naoClicar">Pesquisar Por</option>
                    <option value="nomeCurso">Nome</option>
                    <option value="periodoCurso">Periodo</option>
                    <option value="classificacao">Classificação</option>
                </select>
            </div>
            <p class="text-right">
                <button type="submit" name="btnBusca" class="btn btn-primary">Buscar</button>
                <button type="submit" name="btnLimpa" class="btn btn-primary">Limpar</button>
                <button type="submit" name="btnNovo" class="btn btn-primary">Novo</button>
            </p>
            <table class="table">
                <tr>
                    <th>Ação <button type="submit" name="desorder" value="codCurso"><i class=" icon-chevron-down"></i></button></th>
                    <th>Nome Curso <button type="submit" name="order" value="nomeCurso"><i class=" icon-chevron-down"></i></button></th>
                    <th>Periodo do Curso <button type="submit" name="order" value="periodoCurso"><i class=" icon-chevron-down"></i></button></th>
                    <th>Classificação <button type="submit" name="desorder" value="classificacao"><i class=" icon-chevron-down"></i></button></th>
                </tr>
                <?php foreach ($retorno as $r => $valor) {
                    ?>
                    <tr class="changeColor">
                        <td>
                            <input class="btn-mini btn-danger" type='button' value='Excluir' onclick="window.location = 'excluirCurso.php?classe=Curso&metodo=deletarCurso&codCurso=<?php echo $valor['codCurso'] ?>'"> 
                            <input class="btn-mini btn-warning" type='button' value='Editar' onclick="window.location = 'editarCurso.php?classe=Curso&metodo=editarCurso&codCurso=<?php echo $valor['codCurso'] ?>'">
                        </td>
                        <td><?php echo $valor['nomeCurso'] ?> </td>
                        <td><?php echo $valor['periodoCurso'] ?></td>
                        <td><?php echo $valor['classificacao'] ?></td>
                    </tr>
                <?php } ?> 
            </table>
        </div>

    </div>      
</form>

<?php include 'footer.html' ?>
