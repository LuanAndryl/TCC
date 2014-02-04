<?php
require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include_once 'topo.php';

$rota = new AplicationRoute();

$retorno = $rota->getParams('Aluno', 'selectAluno');

if (isset($_REQUEST['btnBusca']))
    $retorno = $rota->getParams('Aluno', 'selectAluno', NULL, "WHERE {$_POST['opcao']} LIKE  '{$_POST['txtPesq']}%'");
if (isset($_REQUEST['btnLimpa']))
    $retorno = $rota->getParams('Aluno', 'selectAluno');
if (isset($_REQUEST['btnNovo']))
    protegeAcesso::_redirect("Location: cadastroAluno.php");


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
                    <option value="nomeAluno">Nome</option>
                    <option value="emailAluno">Periodo</option>
                    <option value="rgAluno">Rg</option>
                    <option value="emailResponsavel">Email</option>
                    <option value="telefoneResponsavelAluno">Telefone</option>
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
                    <th>Nome Aluno</th>
                    <th>Rg Aluno</th>
                    <th>Data de Nasc</th>
                    <th>Email</th>
                    <th>Email Responsavel</th>
                    <th>Telefone Responsavel</th>
                </tr>
                <?php foreach ($retorno as $r => $valor) { ?>
                    <tr class="changeColor">
                        <td>
                            <input class="btn-mini btn-warning" type='button' value='Editar' onclick="window.location = 'editarAluno.php?classe=Aluno&metodo=editarAluno&codAluno=<?php echo $valor['codAluno'] ?>'"> 
                            <input class="btn-mini btn-danger" type='button' value='Excluir' onclick="window.location = 'excluirAluno.php?classe=Aluno&metodo=deletarAluno&codAluno=<?php echo $valor['codAluno'] ?>'">
                        </td>
                        <td><?php echo $valor['nomeAluno'] ?></td>
                        <td><?php echo $valor['rgAluno'] ?></td>
                        <td><?php echo $valor['dataNascAluno'] ?></td> 
                        <td><?php echo $valor['emailAluno'] ?></td> 
                        <td><?php echo $valor['emailResponsavel'] ?></td> 
                        <td><?php echo $valor['telefoneResponsavelAluno'] ?></td> 
                    </tr>
                <?php } ?>
            </table>
        </div>

    </div>      
</form>

<?php include 'footer.html' ?>