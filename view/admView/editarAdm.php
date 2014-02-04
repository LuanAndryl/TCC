<?php
require_once '../../lib/AplicationRoute.php';
require_once '../../lib/protegeAcesso.php';
include_once 'topo.php';

$rota = new AplicationRoute();
if (isset($_REQUEST['btnAt'])) {
    $rota->setParams('Admistrador', 'editarAdministrador');
    protegeAcesso::_redirect('Location: home.php');
}
?>
<form method="post">
    <div class="hero-unit">

        <!-- Dados do Funcionario --> 
        <div class="control-group">
            <h4>Seu Nome</h4>
            <input class="input-xxlarge" name="nomeAdmin" value="<?php echo $adm[0]['nomeAdmin']; ?>" type="text" required data-required data-pattern="[a-zA-Z]{0,40}"/>
        </div>
        <div class="control-group">
            <h4>Seu Login</h4> 
            <input class="input-medium" name="loginAdmin" value="<?php echo $adm[0]['loginAdmin']; ?>" type="text" required data-required data-pattern="[a-zA-Z]{0,40}"/>
        </div>  
        <div class="control-group">
            <h4>Sua Senha</h4> 
            <input type="password" class="input-medium" name="senhaAdmin" value="<?php echo $adm[0]['senhaAdmin']; ?>" required data-required data-pattern="^[0-9]+$"/>
        </div>
        <input type="hidden" name="codAdministrador" value="<?php echo $adm[0]['codAdministrador']; ?>" >
        <!-- Botões do Form -->
        <div class="form-actions">
            <button type="submit" name="btnAt" value="Atualizar" class="btn btn-warning">Atualizar</button>
            <input class="btn" type='button' value='Cancelar' onclick="window.location = 'home.php'">
        </div>
    </div>
</form>
<?php include 'footer.html' ?>