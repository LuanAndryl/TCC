<?php

require_once '../../lib/AplicationRoute.php';

$rota = new AplicationRoute();
$presente = $rota->getParams('Chamada', 'selectAlunoSituacao', 1);
$meiaFalta = $rota->getParams('Chamada', 'selectAlunoSituacao', 2);
$falta = $rota->getParams('Chamada', 'selectAlunoSituacao', 3);

if ($_POST) {
    $codBar = $_POST['codBarras'];
    $rota->setParams('Chamada', 'addFrequenciaEt');
}
include 'topo.php';
?>


<script>
    chamada.codBarras.focus();
</script>

<form name="chamada" method="post" action="#CodBarras">
    <div class="hero-unit">
        <h4>Turma:Turma 1<br>  Materia: DTCC <br> Professor: Cicrano</h4><br>
        <table class="table table-bordered">
            <tr>
                <th>Data Referente</th>
                <th>Codigo de Barras</th>
                <th>Confirmar</th>
            </tr>
            <tr>
                <td>01/06/2013 00:09</td>
                <td>

                    <a name="codBarras"> </a>
                    <input class="input-xlarge" name="codBarras" id="codBarras" type="text" placeholder ="ex:123931" required onblur="this.form.submit();" >


                </td>
                <td><button name="btnOk" type="submit" class="btn btn-success"><i class="icon-ok"></i></button></td>
            </tr>
        </table>

        <h4> Alunos Presentes</h4>
        <table class="table table-bordered">
            <tr style="width: 50%">
                <th style="width: 50%">Nome Aluno</th>
                <th style="width: 50%">Codigo de Barras</th>
            </tr>
            <?php foreach ($presente as $p => $valor) { ?>
                <tr class='changeColor success' style="width: 50%" >
                    <td><?php echo $valor['nomeAluno'] ?></td>
                    <td><?php echo $valor['codaBar'] ?></td>
                </tr>
            <?php } ?>
        </table>

        <h4> Alunos Meia Falta</h4>
        <table class="table table-bordered">
            <tr  width="50%">
                <th style="width: 50%">Nome Aluno</th>
                <th style="width: 50%">Codigo de Barras</th>
            </tr>
            <?php foreach ($meiaFalta as $p => $valor) { ?>
                <tr class='changeColor warning' width="50%">
                    <td><?php echo $valor['nomeAluno'] ?></td>
                    <td><?php echo $valor['codaBar'] ?></td>
                </tr>
            <?php } ?>
        </table>

        <h4> Alunos Ausentes</h4>
        <table class="table table-bordered">
            <tr  width="50%">
                <th style="width: 50%">Nome Aluno</th>
                <th style="width: 50%">Codigo de Barras</th>
            </tr>
            <?php foreach ($falta as $p => $valor) { ?>
                <tr class='changeColor error'>
                    <td><?php echo $valor['nomeAluno'] ?></td>
                    <td><?php echo $valor['codaBar'] ?></td>
                </tr>
            <?php } ?>
        </table>
        <div class="form-actions">

            <input class="btn btn-primary" type='button' value='Confirmar' onclick="window.location = 'preChamada.php?codMateria=<?php echo "{$_GET['codMateria']}&codProf={$_GET['codProf']}" ?>'"> 
        </div>
    </div>
</form>
<?php include 'footer.html' ?>