<?php
require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include_once 'topo.php';

$rota = new AplicationRoute();
$retorno = $rota->getParams('Professor', 'selectProfActive');

if (isset($_REQUEST['btnBusca'])) {
    if ($_POST['opcao'] == 'naoClicar') {
        echo '<p class="text-right"><h4>Escolha uma opção</h4></p>';
    } else {
        $retorno = $rota->getParams('Professor', 'selectProfActive', NULL, "{$_POST['opcao']} LIKE  '%{$_POST['txtPesq']}%'");
    }
}
if (isset($_REQUEST['btnNovo']))
    protegeAcesso::_redirect("Location: cadastroProfessor.php");
if (isset($_REQUEST['btnLimpa']))
    $retorno = $rota->getParams('Professor', 'selectProfActive');
if (isset($_REQUEST['btnIna']))
    protegeAcesso::_redirect("Location: relatorioProfessorInativo.php");

if (isset($_REQUEST['order'])) {
    $retorno = $rota->getParams('Professor', 'selectOrderAt');
}
if (isset($_REQUEST['desorder'])) {
    $retorno = $rota->getParams('Professor', 'selectProfessor');
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
            <table class="table">
                <tr>
                    <th>Ação <button type="submit" name="desorder" value="codProf"><i class=" icon-chevron-down"></i></button></th>
                    <th>Nome Professor <button type="submit" name="order" value="nomeProf"><i class=" icon-chevron-down"></i></button></th>
                    <th>Email Pofessor <button type="submit" name="order" value="emailProf"><i class=" icon-chevron-down"></i></button></th>
                    <th>Matricula Professor <button type="submit" name="desorder" value="matriculaProf"><i class=" icon-chevron-down"></i></button></th>
                </tr>
                <?php foreach ($retorno as $r => $valor) { ?>
                    <tr class="changeColor">
                        <td>
                            <input class="btn-mini btn-warning" type='button' value='Editar' onclick="window.location = 'editarProfessor.php?classe=Professor&metodo=editarProfessor&codProf=<?php echo $valor['codProf'] ?>'"> 
                            <input class="btn-mini btn-danger" type='button' value='Desativar' onclick="window.location = 'desativarProfessor.php?classe=Professor&metodo=desativarProfessor&codProf=<?php echo $valor['codProf'] ?>'">
                        </td>
                        <td><?php echo $valor['nomeProf'] ?> </td>
                        <td><?php echo $valor['emailProf'] ?></td>
                        <td><?php echo $valor['matriculaProf'] ?></td>

                    <?php } ?> 
                </tr>
            </table>
        </div>

    </div>      
</form>

<?php include 'footer.html' ?>