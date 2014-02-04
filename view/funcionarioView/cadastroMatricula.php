<?php
require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include_once 'topo.php';
include 'menuRelatorio.html';

$rota = new AplicationRoute();

$retorno = $rota->getParams('Aluno', 'selectAlunoActive');

if (isset($_REQUEST['btnBusca'])) {
    if ($_POST['opcao'] == 'naoClicar') {
        echo '<p class="text-right"><h4>Escolha uma opção</h4></p>';
    } else {
        $retorno = $rota->getParams('Aluno', 'selectAlunoActive', NULL, "{$_POST['opcao']} LIKE  '%{$_POST['txtPesq']}%'");
    }
}
if (isset($_REQUEST['btnLimpa']))
    $retorno = $rota->getParams('Aluno', 'selectAlunoActive');
if (isset($_REQUEST['btnNovo']))
    protegeAcesso::_redirect("Location: cadastroAluno.php");
if (isset($_REQUEST['btnIna']))
    protegeAcesso::_redirect("Location: relatorioAlunoInativo.php");

if (isset($_REQUEST['bntMatricular']))
    $rota->setParams('Matricula', 'addMatricula');

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
                    <option value="emailAluno">Email Aluno</option>
                    <option value="rgAluno">Rg</option>
                    <option value="emailResponsavel">Email</option>
                    <option value="telefoneResponsavelAluno">Telefone</option>
                </select>
            </div>
            <p class="text-right">
                <button type="submit" name="btnBusca" class="btn btn-primary">Buscar</button>
                <button type="submit" name="btnLimpa" class="btn btn-primary">Limpar</button>
                <button type="submit" name="btnNovo" class="btn btn-primary">Novo</button>
                <button type="submit" name="btnIna" class="btn btn-inverse">Alunos Inativos</button>
            </p>
            <table class="table">
                <tr>
                    <th>Ação</th>
                    <th>Nome Aluno</th>
                    <th>Rg Aluno</th>
                    <th>Data de Nasc</th>
                </tr>
                <?php
                foreach ($retorno as $r => $valor) {
                    $confMat = $rota->getParams('Matricula', 'selectMatriculado', $valor['codAluno'], $_GET['codTurma'], $_GET['codCurso']);
                    if ($confMat == true) {
                        ?>
                        <tr class="changeColor">
                            <td>
                                <button type="submit" name="bntMatricular" value="<?php echo $valor['codAluno'] ?>" class="btn btn-mini btn-success" >Matricular</button>
                            </td>
                            <td><?php echo $valor['nomeAluno'] ?></td>
                            <td><?php echo $valor['rgAluno'] ?></td>
                            <td><?php echo $valor['dataNascAluno'] ?></td>
                        </tr>
                    <?php } ?>   
                <?php } ?>
            </table>
        </div>
    </div>      
</form>

<?php include 'footer.html' ?>