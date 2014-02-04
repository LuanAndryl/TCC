<?php

require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include_once 'topo.php';

$rota = new AplicationRoute();

$alunos = $rota->getParams('Barcode', 'selectAlunosByTurma');
if (isset($_REQUEST['btnSalvar'])) {
    $rota->setParams('Barcode', 'geraBarCode');
}

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
                    <option value="teleFoneResponsavelAluno">Telefone</option>
                </select>
            </div>
            <p class="text-right">
                <button type="submit" name="btnBusca" class="btn btn-primary">Buscar</button>
                <button type="submit" name="btnLimpa" class="btn btn-primary">Limpar</button>
                <button type="submit" name="btnNovo" class="btn btn-primary">Novo</button>
            </p>

            <table class="table">
                <th>Cod Aluno</th>
                <th>Nome Aluno</th>
                <th>Turma</th>
                </tr>
                <?php foreach ($alunos as $a => $valor) { ?>
                    <tr class="changeColor" >
                        <td><?php echo $valor['codAluno'] ?></td>
                        <td><?php echo $valor['nomeAluno'] ?></td>
                        <td><?php echo $valor['moduloTurma'] . " - " . $valor['prefixoTurma'] ?></td>              
                    </tr>
                <?php } ?>
            </table>
        </div>
        <div class="form-actions">
            <button name="btnSalvar" type="submit" class="btn btn-primary">Gerar</button>
            <a class="btn btn-primary" href="outputPdf.php?codTurma=<?php echo $_GET['codTurma'] ?>" target="_blanck" >Imprimir</a>
            <input class="btn" type='button' value='Cancelar' onclick="window.location = 'relatorioAlunoAtivo.php'">
        </div>
    </div> 
</form>
<?php include 'footer.html' ?>

