<?php

require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include_once 'topo.php';

require_once $_SERVER['DOCUMENT_ROOT'] . "/app/lib/protegeAcesso.php";

$rota = new AplicationRoute();
$retorno = $rota->getParams('Auditoria', 'selectAuditoria');

if (isset($_REQUEST['btnBusca'])) {
    if ($_POST['campo'] == 'naoClicar') {
        echo "<script language=javascript>
                                alert('Escolha uma opçao');
                        </script>";
    } else {
        $retorno = $rota->getParams('Auditoria', 'selectSearch');
    }
}
if (isset($_REQUEST['btnLimpa']))
    $retorno = $rota->getParams('Auditoria', 'selectAuditoria');

if (isset($_REQUEST['order'])) {
    $retorno = $rota->getParams('Turma', 'selectOrder');
}
if (isset($_REQUEST['desorder'])) {
    $retorno = $rota->getParams('Turma', 'selectRead');
}

?>
<form method="post">
    <div class="hero-unit">
        <div class="row-fluid">
            <input class="input-block-level search-query" name="txtPesq"type="text" placeholder="Digite sua Busca">
            <br><br>
            <div class="span8">
                <select name="campo">
                    <option value="naoClicar" >Pesquisar Por</option>
                    <option value="loginUsuario">Usuario</option>
                    <option value="nivelUsuario">Nivel </option>
                    <option value="acao">Ação Usuario</option>
                    <option value="arquivo">Arquivo Requisitado</option>
                </select>
            </div>
            <p class="text-right">
                <button type="submit" name="btnBusca" class="btn btn-primary">Buscar</button>
                <button type="submit" name="btnLimpa" class="btn btn-primary">Limpar</button>
            </p>
            <table class="table">
                <tr>
                    <th>Usuario <button type="submit" name="order" value="curso.classificacao"><i class=" icon-chevron-down"></i></button></th>
                    <th>Nivel <button type="submit" name="order" value="turma.moduloTurma"><i class=" icon-chevron-down"></i></button></th>
                    <th>Data / Hora <button type="submit" name="order" value="curso.nomeCurso"><i class=" icon-chevron-down"></i></button></th>
                    <th>Ação do Usuario <button type="submit" name="order" value="curso.periodoCurso"><i class=" icon-chevron-down"></i></button></th>
                    <th>Arquivo Requisitado <button type="submit" name="order" value="turma.moduloTurma"><i class=" icon-chevron-down"></i></button></th>

                </tr>
                <tr>
                    <?php foreach ($retorno as $r => $valor) { ?>
                    <tr class ="changeColor">
                        <?php
                        if ($valor['nivelUsuario'] == 'Adminstrador')
                            $span = "<span class='label label-important'>";
                        if ($valor['nivelUsuario'] == 'Funcionario')
                            $span = "<span class='label label-inverse'>";
                        if ($valor['nivelUsuario'] == 'Professor')
                            $span = "<span class='label label-info'>";
                        if ($valor['nivelUsuario'] == 'Aluno')
                            $span = "<span class='label label-warning'>";
                        if ($valor['nivelUsuario'] == 'Logado sem Atividade')
                            $span = "<span class='label'>";
                        ?>
                        <td><?php echo $span . $valor['loginUsuario'] . "</span>"; ?></td>
                        <td><?php echo $span . $valor['nivelUsuario'] . "</span>" ?></td>
                        <td><?php echo protegeAcesso::arumaDataHora($valor['dataAcao']) ?></td>
                        <td><?php echo $valor['acao'] ?></td>
                        <td><?php echo $valor['arquivo'] ?></td>
                    </tr>
                <?php } ?> 
            </table>
        </div>

    </div>  
</form>

<?php include 'footer.html' ?>
