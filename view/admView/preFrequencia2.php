<?php include 'topo.php' ?>
<div class="hero-unit">
    <form method="post">
        <div class="row-fluid">
            <div class="span6">
                <h4>Selecione uma Forma de Frenquencia</h4>
                <label class="radio"><input type="radio" name="forma" id="opcao1" value="mensal" checked>Mensal</label>
                <label class="radio"><input type="radio" name="forma" id="opcao2" value="bimestral">Bimestral</label>    
                <label class="radio"><input type="radio" name="forma" id="opcao3" value="semestral">Semestral</label>
                <label class="radio"><input type="radio" name="forma" id="opcao4" value="anual">Anual</label>
            </div>

            <div class="span6">
                <h4>Selecione uma Data</h4>
                <select>
                    <option>Janeiro</option>
                    <option>Fevereiro</option>
                    <option>Março</option>
                </select>
                <br>
                    <input class="btn btn-primary" value="Confirmar" onclick="window.location ='frequencia.php'">
                    <button type="submit" class="btn">Voltar</button>
               

                </form>
            </div>
        </div>
</div>

<?php include 'footer.html' ?>