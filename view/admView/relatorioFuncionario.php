<?php
require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include_once 'topo.php';

$rota = new AplicationRoute();

$retorno = $rota->getParams('Funcionario', 'selectFunc');

if (isset($_REQUEST['btnBusca']))
    $retorno = $rota->getParams('Funcionario', 'selectFunc', NULL, "WHERE {$_POST['opcao']} LIKE  '{$_POST['txtPesq']}%'");
if (isset($_REQUEST['btnLimpa']))
    $retorno = $rota->getParams('Funcionario', 'selectFunc');
if (isset($_REQUEST['btnNovo']))
    protegeAcesso::_redirect("Location: cadastroFuncionario.php");


include 'menuRelatorio.html';
?>
<form method="post">
    <div class="hero-unit">
        <div class="row-fluid">
            <input class="input-block-level search-query" name="txtPesq" type="text" placeholder="Digite sua Busca">
            <br><br>
            <div class="span8">
                <select name="opcao">
                    <option>Pesquisar Por</option>
                    <option value="nomeFunc">Nome</option>
                    <option value="loginFunc">Login</option>
                </select>
            </div>
            <p class="text-right">
                <button type="submit" name="btnBusca" class="btn btn-primary">Buscar</button>
                <button type="submit" name="btnLimpa" class="btn btn-primary">Limpar</button>
                <button type="submit" name="btnNovo" class="btn btn-primary">Novo</button>
            </p>
            <table class="table">
                <tr>
                    <th>Ação</th>
                    <th>Nome Funcionario</th>
                    <th>Login do Funcionario</th>
                </tr>
                <tr>
                    <?php foreach ($retorno as $r => $valor) {
                        ?>
                    <tr class="changeColor">
                        <td>
                            <input class="btn-mini btn-warning" type='button' value='Editar' onclick="window.location = 'editarFuncionario.php?classe=Funcionario&metodo=editarFunc&codFunc=<?php echo $valor['codFunc'] ?>'"> 
                            <input class="btn-mini btn-danger" type='button' value='Excluir' onclick="window.location = 'excluirFuncionario.php?classe=Funcionario&metodo=deletarFunc&codFunc=<?php echo $valor['codFunc'] ?>'">

                        </td>
                        <td><?php echo $valor['nomeFunc'] ?> </td>
                        <td><?php echo $valor['loginFunc'] ?></td>
                    </tr>
                <?php } ?> 
            </table>
        </div>

    </div>      
</form>

<?php include 'footer.html' ?>
