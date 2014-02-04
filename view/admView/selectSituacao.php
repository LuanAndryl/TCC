<?php
require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include_once 'topo.php';

if (isset($_REQUEST['btnSalvar'])) {
    protegeAcesso::_redirect("Location: relatorioMatricula.php?codTurma={$_GET['codTurma']}&codCurso={$_GET['codCurso']}&codMateria={$_GET['codMateria']}&situacao={$_POST['situacao']}");
    exit();
}

?>
<form method="post">
    <div class="hero-unit">
        <div class="row-fluid">
            <div class="span6">

                <!-- Combo dos cursos -->

                <p class="text-center">
                <h4>Selecione a situação</h4>
                <select name="situacao"> 
                    <option value="1" >Matriculado</option>
                    <option value="2" >Ae - Aproveitamento de estudo</option>
                    <option value="3" >Trancado</option>
                    <option value="4" >Desistente</option>
                    <option value="5" >Formado</option>
                </select>
            </div>
            <div class="form-actions">
                <!--Botoes do Form-->
                <button name="btnSalvar" type="submit" class="btn btn-primary">Ok</button>
                <input name="btnLimpar" type="submit" value="Cancelar" class="btn">
            </div>
        </div>
    </div>  
</form>

<?php include 'footer.html' ?>
