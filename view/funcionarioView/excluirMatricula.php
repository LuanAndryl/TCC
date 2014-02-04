<?php include 'topo.php' ?>

<div class="hero-unit">
    <div class="row-fluid">
        <div class="span8">
            <table class="table">
                <tr>
                    <!-- Formulario de pesquisa -->
                <input class="input-block-level" type="text" placeholder="Digite aqui a oque deseja buscar">
                </tr>
                <br />

                <!-- Botoes de pesquisa -->

                <p class="text-right">
                    <button type="submit" class="btn">Buscar</button>
                </p>
                </form>

                <!-- Tabela puxando os registros -->

                <br />
                <tr>
                    <th>Marcar</th>
                    <th>Nome Aluno</th>
                    <th>Rg do Aluno</th>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" value="">
                    </td>
                    <td>puxa banco nome1</td>
                    <td>puxa banco rg1</td>               
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" value="">
                    </td>
                    <td>puxa banco nome2</td>
                    <td>puxa banco rg3</td>               
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" value="">
                    </td>
                    <td>puxa banco nome3</td>
                    <td>puxa banco rg3</td>               
                </tr>
            </table>
        </div>
        <div class="span2">

            <h4>Selecione o Curso</h4>
            <select> 
                <option>Curso1</option>
                <option>Cursso2</option>
            </select>
            <br>
            <h4>Selecione a Turma</h4>
            <select> 
                <option>Turma 1</option>
                <option>Turma 2</option>
            </select>

            <div class="span2 offset1">
                <button type="submit" class="btn btn-danger">Excluir</button>
            </div>
            <div class="span2 offset5">
                <button type="button" class="btn">Cancelar</button>
            </div>    
        </div>            
    </div>
</div>

<?php include 'footer.html' ?>