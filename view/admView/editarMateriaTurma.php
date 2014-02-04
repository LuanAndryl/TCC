<?php

require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include_once 'topo.php';

$rota = new AplicationRoute();
$materia = $rota->getParams('Materia', 'selectMateria', null, "where codCurso={$_GET['codCurso']} and atribuir=1");
$curso = $rota->getParams('Curso', 'selectCurso', null, "where codCurso={$_GET['codCurso']}");
$turma = $rota->getParams('Turma', 'selectTurma', null, "where codCurso={$_GET['codCurso']}");

?>
<form method="post">
    <div class="hero-unit">
        <div class="row-fluid">
            <!-- Combo dropdown das Materias -->
            <h4> Materias referentes ao curso <?php echo "{$curso[0]['nomeCurso']} na Turma {$turma[0]['codTurma']}-{$turma[0]['prefixoTurma']}" ?> <h4>
                    <div class="span6">
                        <p class="text-center">
                            <!-- Combo dropdown dos Professores -->
                    </div>

                    <div class="span12">
                        <?php if (!empty($materia)) { ?>
                            <table class="table">
                                <tr>
                                    <th>Atribuir</th>
                                    <th>Materia</th>
                                </tr>
                                <?php foreach ($materia as $m => $valor) { ?>
                                    <tr class="changeColor">
                                        <td> <input class="btn-mini btn-warning" type='button' value='Editar' onclick="window.location = 'efetuarEditarMateriaTurma.php?codCurso=<?php echo $_GET['codCurso'] ?>&codMateria=<?php echo $valor['codMateria'] ?>'">  </td>
                                        <td> <?php echo $valor['nomeMateria'] ?> </td>
                                    </tr>
                                <?php } ?>
                            </table>
                        <?php } else { ?> 
                            Nenhuma materia Cadastrada, o que deseja fazer agora? <br /><br />
                            <input class="btn btn-primary" type='button' value='Cadastrar' onclick="window.location = 'cadastroMateria.php?codCurso=<?php echo $_GET['codCurso'] ?>'"> 
                            <input class="btn btn-info" type='button' value='Escolher outro Curso' onclick="window.location = 'preCadastroMateriaTurma.php'"> 
                        <?php } ?>
                    </div>

                    <!-- Combo dropdown das Materias -->
                    </div>
                    <div class="form-actions">
                        <input class="btn btn" type='button' value='Voltar' onclick="window.location = 'relatorioMateriaTurma.php'">
                    </div>
                    </div>
                    </form>

                    <?php include 'footer.html'
                    ?>
