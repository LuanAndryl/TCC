<?php
include 'topo.php';

$btnAdd = "<a href = '#myModal' role = 'button' class = 'btn-small btn' data-toggle = 'modal'>Add</a>
                                                <!--Modal-->
<div id = 'myModal' class = 'modal hide fade' tabindex = '-1' role = 'dialog' aria-labelledby = 'myModalLabel' aria-hidden = 'true'>
    <div class = 'modal-header'>
        <button type = 'button' class = 'close' data-dismiss = 'modal' aria-hidden = 'true'>×</button>
        <h3 id = 'myModalLabel'>Professores</h3>
    </div>
    <div class = 'modal-body'>
        <p><input class='input-block-level' type='text' placeholder='Nome do Professor'></p>
        <button type='submit' class='btn btn-primary'>Pesquisar</button>
        <br/><br/>
        <table class='table table-bordered'>
            <tr>
                    <th>Nome Professor</th>
                    <th>Matricula</th>
                    <th>X</th>
                </tr>
                <tr>
                    <td>puxa banco professor1</td>
                    <td>puxa banco matricula1</td>
                    <td><input type='checkbox' value=''></td>
                </tr>
                <tr>
                    <td>puxa banco professor2</td>
                    <td>puxa banco matricula2</td>
                    <td><input type='checkbox' value=''></td>
                </tr>
                <tr>
                    <td>puxa banco professor3</td>
                    <td>puxa banco professor4</td>
                    <td><input type='checkbox' value=''></td>
                </tr>
             </table>
        
    </div>
    <div class = 'modal-footer'>
        <button class = 'btn' data-dismiss = 'modal' aria-hidden = 'true'>Fechar</button>
        <button class = 'btn btn-primary'>Adicionar</button>
    </div>
</div>";
?>

<div class="hero-unit">
    <div class="row-fluid">
        <div class="span6">

            <!-- Combo dos cursos -->

            <p class="text-center">
            <h4>Selecione o Curso</h4>
            <select> 
                <option>Curso1</option>
                <option>Cursso2</option>
            </select>
            <!-- Combo das Turmas -->
        </div>

        <!-- Combo dropdown das Materias -->

        <div class="span6">
            <p class="text-center">
            <h4>Selecione a Turma</h4>
            <select> 
                <option value="">Turma1</option>
                <option value="">Turma2</option>
            </select>
            <br/>
            <br/>
            <!-- Combo dropdown dos Professores -->
        </div>
        <div class="span12">
            <table class="table">
                <tr>
                    <th>Materia</th>
                    <th>Professor</th>
                </tr>
                <tr>
                    <td>Materia1</td>
                    <td><?php echo $btnAdd?></td>                  
                </tr>
                <tr>
                    <td>Materia2</td>                        
                    <td><?php echo $btnAdd?></td>                  
                </tr>
                <tr>
                    <td>Materia3</td>            
                    <td><?php echo $btnAdd?></td>              
                </tr>
            </table>
        </div>

        <!-- Combo dropdown das Materias -->
        <p class="text-center">
            <button type="submit" class="btn btn-danger">Excluir</button>
            <button type="button" class="btn">Cancelar</button>
        </p>
    </div>
</div>


<?php include 'footer.html' ?>
