<?php

require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include_once 'topo.php';

?>
<form method="post">
    <div class="hero-unit">

        <!-- Formularios Simples -->

        <p class="text-center"> <h4>Nome do Aluno</h4> <input disabled class="input-xlarge" name="nomeAluno" value="<?php echo $aln[0]['nomeAluno'] ?>" type="text"placeholder ="ex: João Pereira Souza da Cunha Junior"</p>
        <p class="text-center"> <h4>Data de Nascimento</h4> <input disabled class="input-medium" name="dataNascAluno" value="<?php echo $aln[0]['dataNascAluno'] ?>" type="text"placeholder ="ex: dd/mm/aaaa"</p>
        <p class="text-center"> <h4>Rg do Aluno</h4> <input disabled class="input-large" name="rgAluno" value="<?php echo $aln[0]['rgAluno'] ?>" type="text"placeholder ="ex:457849833"</p>
        <p class="text-center"> <h4>Email do Aluno</h4> <input disabled class="input-xlarge" name="emailAluno" value="<?php echo $aln[0]['emailAluno'] ?>" type="text"placeholder ="ex: joaosouza@hotmail.com"</p>
        <p class="text-center"> <h4>Email do Responsavel</h4> <input disabled class="input-xlarge" name="emailResponsavel" value="<?php echo $aln[0]['emailResponsavelAluno'] ?>" type="text"placeholder ="ex: responsaveldoaluno@hotmail.com"</p>
        <p class="text-center"> <h4>Telefone do Responsavel</h4> <input disabled class="input-medium" name="telefoneResponsavel" value="<?php echo $aln[0]['telefoneResponsavelAluno'] ?>"  type="text"placeholder ="ex: 14 3322-4455"</p>

        <!-- Botões do Form -->

        <div class="form-actions">
            <input class="btn" type='button' value='Voltar' onclick="window.location = 'home.php'"> 
            
        </div>
    </div>
</form>
<?php include 'footer.html' ?>