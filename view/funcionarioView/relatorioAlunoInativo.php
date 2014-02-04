<?php
require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include_once 'topo.php';

$rota = new AplicationRoute();

$retorno = $rota->getParams('Aluno', 'selectAlunoInactive');

if (isset($_REQUEST['btnBusca'])) {
    if ($_POST['opcao'] == 'naoClicar') {
        echo "<script language=javascript>
                                alert('Escolha uma opçao');
                        </script>";
        //echo '<p class="text-right"><h4>Escolha uma opção</h4></p>';
    } else {
        $retorno = $rota->getParams('Aluno', 'selectAlunoInactive', NULL, "{$_POST['opcao']} LIKE  '%{$_POST['txtPesq']}%'");
    }
}
if (isset($_REQUEST['btnLimpa']))
    $retorno = $rota->getParams('Aluno', 'selectAlunoInactive');
if (isset($_REQUEST['btnNovo']))
    protegeAcesso::_redirect("Location: cadastroAluno.php");
if (isset($_REQUEST['btnAt']))
    protegeAcesso::_redirect("Location: relatorioAlunoAtivo.php");

if (isset($_REQUEST['order'])) {
    $retorno = $rota->getParams('Aluno', 'selectOrderIn');
}
if (isset($_REQUEST['desorder'])) {
    $retorno = $rota->getParams('Aluno', 'selectAlunoInactive');
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
                <button type="submit" name="btnAt" class="btn btn-success">Alunos Ativos</button>
            </p>
            <table class="table">
                <tr>
                    <th >Ação <br /><button type="submit" name="desorder" value="codAluno"><i class=" icon-chevron-down"></i></button></th>
                    <th>Nome Aluno <br /><button type="submit" name="order" value="nomeAluno"><i class=" icon-chevron-down"></i></button></th>
                    <th>Rg Aluno <br /><button type="submit" name="order" value="rgAluno"><i class=" icon-chevron-down"></i></button></th>
                    <th>Data de Nasc <br /><button type="submit" name="order" value="dataNascAluno"><i class=" icon-chevron-down"></i></button></th>
                    <th>Email <br /><button type="submit" name="order" value="emailAluno"><i class=" icon-chevron-down"></i></button></th>
                    <th>Email Responsavel <br /><button type="submit" name="order" value="emailResponsavelAluno"><i class=" icon-chevron-down"></i></button></th>
                    <th>Telefone Responsavel <br /><button type="submit" name="order" value="telefoneResponsavelAluno"><i class=" icon-chevron-down"></i></button></th>

                </tr>
                <?php foreach ($retorno as $r => $valor) { ?>
                    <tr class="changeColor">
                        <td>
                            <input class="btn-mini btn-warning" type='button' value='Editar' onclick="window.location = 'editarAluno.php?classe=Aluno&metodo=editarAluno&codAluno=<?php echo $valor['codAluno'] ?>'"> 
                            <input class="btn-mini btn-success" type='button' value='Ativar' onclick="window.location = 'ativarAluno.php?classe=Aluno&metodo=ativarAluno&codAluno=<?php echo $valor['codAluno'] ?>'">
                        </td>
                        <td><?php echo $valor['nomeAluno'] ?></td>
                        <td><?php echo $valor['rgAluno'] ?></td>
                        <td><?php echo $valor['dataNascAluno'] ?></td> 
                        <td><?php echo $valor['emailAluno'] ?></td> 
                        <td><?php echo $valor['emailResponsavelAluno'] ?></td> 
                        <td><?php echo $valor['telefoneResponsavelAluno'] ?></td> 
                    </tr>
                <?php } ?>
            </table>
        </div>

    </div>      
</form>

<?php include 'footer.html' ?>