<?php include 'topo.php' ?>

<div class="hero-unit">
    <h4>Turma:Turma 1 Tecnico<br>  Materia: DTCC <br> Professor: Cicrano</h4><br>
    <table class="table table-bordered">

        <tr>
            <th>Data Referente</th>
            <th>Codigo de Barras</th>
            <th>Confirmar</th>
        </tr>
        <tr>
            <td>01/06/2013 00:09</td>
            <td><input class="input-xlarge" name="codBarras" type="text"placeholder ="ex:123931"></td>
            <td><a class="btn btn-success" href="#"><i class="icon-ok"></i></a>
        </tr>
    </table>
    <!-- se o aluno veio parcialmente a line fica laranja se nao fica verde .... nao veio em nenhum nao aparece !-->
    <table class="table table-bordered">
        <tr class='changeColor'>
            <th>Alunos Presentes</th>
            <th>Parcial</th>
            <th>Final</th>
        </tr>
        <tr class="changeColor success">
            <td>Aluno que ja passou pelo Leito1</td>
            <td><i class="icon-ok"></i></td>
            <td><i class="icon-ok"></i></td>
        </tr>
        <tr class="changeColor error">
            <td>Aluno que ja passou pelo Leito1</td>
            <td><i class="icon-remove"></i></td>
            <td><i class="icon-ok"></i></td>
        </tr>
        <tr class="changeColor success">
            <td>Aluno que ja passou pelo Leito1</td>
            <td><i class="icon-ok"></i></td>
            <td><i class="icon-ok"></i></td>
        </tr>
    </table>
    <div class="form-actions">
        <input class="btn-small btn-primary" type='button' value='Finalizar Chamada Parcial' onclick="window.location = 'chamada2.2.php'"> 
        <input class="btn-small btn" type='button' value='Cancelar' onclick="window.location = 'preChamada.php'"> 
    </div>
</div>
<?php include 'footer.html' ?>